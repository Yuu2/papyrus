# Security

## 개요 (Summary)
- Install
```
bin/console make:user
```

## 등록 (Registration)
- Component
```
composer require symfony/orm-pack symfony/form symfony/security-bundle symfony/validator
```
- User
```php
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=64)
     */
    private $password;
```
- FormType
```php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('email', EmailType::class)
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options'  => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ])
        ->add('save', SubmitType::class, ['label' => 'Register'])
        ;
    }
```
- Controller
```php
$user = new SecurityUser();

$form = $this->createForm(RegisterUserType::class, $user);
$form->handleRequest($request);

if($form->isSubmitted() && $form->isValid()) {

   $user->setPassword(
        $passwordEncoder->encodePassword($user, $form->get('password')->getData())
   );

   $user->setEmail($form->get('email')->getData());

   $entityManager = $this->getDoctrine()->getManager();
   $entityManager->persist($user);
   $entityManager->flush();

   return $this->redirectToRoute('home');
}
```


## 로그인 (LogIn)
- security.yaml
```yaml
form_login:
    login_path: LOGIN_PATH
    check_path: CHECK_PATH
    
    username_parameter: 'email' 
    password_parameter: 'password'
    csrf_token_generator: security.csrf.token_manager
```
- Template
```twig
<form method="post">
    {% if error %}
        <div class="alert alert-danger">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
    {% endif %}

    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" value="{{ last_username }}" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <input type="hidden" name="_csrf_token"
           value="{{ csrf_token('authenticate') }}"
    >

    <button class="btn btn-lg btn-primary" type="submit">
        Sign in
    </button>
</form>
```
- Controller
```php
public function login(AuthenticationUtils $authenticationUtils) {
    
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', [
      'last_username' => $lastUsername,
      'error' => $error
    ]);
}
```

## 로그아웃 (LogOut)
: security.yaml
```yaml
logout:
    path: /LOGOUR_PATH
    target: /REDIRECT_PATH
```
: Template
```twig
{% if app.user %}
    <a href="{{ path('logout') }}">LOGOUT</a>
{% endif %}
```
## CSRF
- Template
```twig
<input type="hidden" name="_csrf_token" value="{{ csrf_token('authenticate') }}" >
```

- security.yaml
```yaml
form_login:
    csrf_token_generator: security.csrf.token_manager
```

## 기억하기 (Remember Me)
: security.yaml
```twig
remember_me:
    secret: '%kernel.secret%'
    lifetime: 604800 # 1 week in seconds
    #always_remember_me: true
    path: /
```
: Template
```twig
<input type="checkbox" name="_remember_me"> Remember me
```

## 인가 (Permission)
#### 1. 지역적 범위
- Controller
```php
/**
 *  @Security("has_role('ROLE_ADMIN')")
 */
public function index(Request $request) { 
    // 생략
}
```
##
#### 2. 전역적 범위
- security.yaml
```twig
    access_control:
        - { path: ^/admin, roles: ROLE_ADMIN }
```
: /admin 으로 시작되면 관리자만 접근 할 수 있다.
--
#### 3. 그 외
- Controller
```php
$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')

$this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED')

$this->denyAccessUnlessGranted('ROLE_ADMIN')
```
: 로그인 되어 있을 경우 메소드 처리
--
- Template
```twig
{% is_granted('IS_AUTHENTICATED_FULLY') %}
    HELLO SYMFONY 
{% endif %}
```
: 로그인 되어 있을 경우 표시

## Voter
```
bin/console make:voter

-> TestVoter
```php
$this->denyAccessUnlessGranted('CUSTOMIZE', $test)
```
: 인가처리를 엔티티와 연관시켜 커스터마이즈 할 수 있다.



