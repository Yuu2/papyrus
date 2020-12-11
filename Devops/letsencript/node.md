# Let's encrypt
updated 2020.05.30

##  Web Server의 도메인 인증

##  DNS 레코드 인증
인증 토큰을 DNS에 TXT 레코드로 등록해서 인증하는 방법. <br>
운영 중인 환경에서 쉽게 발급 받을 수 있다.

### Docker Image를 이용한 발급
```sh
docker run -it --rm --name certbot 
  -v '/etc/letsencrypt:/etc/letsencrypt' 
  -v '/var/lib/letsencrypt:/var/lib/letsencrypt'  
  certbot/certbot certonly 
    -d 'example.com' -d 'www.example.com'  
    --manual 
    --preferred-challenges dns 
    --server https://acme-v02.api.letsencrypt.org/directory
```
위의 커맨드를 입력하면 Certbot을 통해 인증 토큰이 발급된다. <br>
호스팅 하고 있는 네임서버에 인증 토큰을 다음의 TXT 레코드로 등록해야 한다.<br>
```
RECORD_NAME : _acme-challenge.example.com
VALUE       : 토큰 값
```
네임서버에 등록 되었는지 확인 한 후
```
nslookup -q=TXT example.com
```
최종적으로 Certbot에 Enter를 누르면 된다.

