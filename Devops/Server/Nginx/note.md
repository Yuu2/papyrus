# NGINX
updated 2020.05.16
<br>

## 개요
웹 서버 소프트웨어로, 가벼움과 높은 성능을 목표로 한다. **더 적은 자원으로 더 빠르게 데이터를 서비스 할 수 있다.**

## 시작하기
웹 서버 Nginx를 설치하기에 앞서 운영체제가 필요하다.
보편적으로 배포용 서버는 리눅스(Linux) 계통을 이용한다.

1. 센토스(CentOS)
2. 페도라(Fedora)
3. 우분투(Ubuntu) 
## 설치하기

### 1-1). 패키지 매니저를 통한 설치
간편하게 All-In-One으로 Nginx를 설치 할 수 있다는 장점이 있다.

#### 우분투(Ubuntu)
APT를 이용하여 설치한다.
```
apt-get update && apt-get install nginx
```
우분투 계열에서는 설치 한 후 실행 중인 프로세스를 확인 해보면 곧 바로 서비스가 시작 됨을 알 수 있다.
```
ps aux | grep nginx

root      1997  0.0  0.1 141112  1576 ?        Ss   17:27   0:00 nginx: master process /usr/sbin/nginx -g daemon on; master_process on;
www-data  2000  0.0  0.6 143788  6212 ?        S    17:27   0:00 nginx: worker process
root     13662  0.0  0.1  14856  1024 pts/0    S+   19:30   0:00 grep --color=auto nginx
```
#### 센토스(CentOS)
Yum을 이용하여 설치한다.
```
yum install nginx
```
만약 nginx를 참조 혹은 설치 할 수 없다고 한다면 (구 CentOS)
```
yum install epel-release
```
epel-release를 설치 해주어야 한다. 그리고 난 후 <br>
nginx를 다시 설치하고 센토스에서는 자동적으로 nginx를 실행시키지 않기에 <br>
커맨드로 실행 시켜 주어야 한다. <br>
```
service nginx start
```

### 1-2). 소스(Source)를 통한 설치법
운영체제 내에서 소스를 다운 받는다.
(예제 환경은 리눅스 Ubuntu 18 에서 진행 했다.)
```
wget http://nginx.org/download/파일.tar.gz

tar -zxvf 파일.tar.gz 
```
#### 2). 의존성 패키지 설치
##### PCRE (Perl Compatible Regular Expressions)
펄 프로그래밍 언어의 정규 표현식 기능에 착안하여 만든, 정규 표현식 C 라이브러리
```
# Ubuntu
apt-get install libpcre3 libpcre3-dev
# CentOS
yum install pcre pcre-devel
```
##### zlib
C로 작성된 데이터 압축 라이브러리의 일종
```
# Ubuntu
apt-get install zlib1g zlib1g-dev
# CentOS
yum install zlib zlib-devel
```
##### libssl
TLS (SSL과 TLS 프로토콜) 을 지원하는 Open SSL 라이브러리이다.
```
apt-get install libssl-dev
yum install openssl-devel
```
### 환경설정
nginx 폴더 하의 **configure** 파일을 통해 명령어로 환경설정을 해야 한다.

```
./configure 

--sbin-path=/usr/bin/nginx (nginx 실행파일 경로)
--conf-path=/etc/nginx/nginx.conf (nginx 설정파일 경로)
--error-log-path=/var/log/nginx/error.log
--http-log-path=/var/log/nginx/access.log
--with-pcre
--pid-path=/var/run/nginx.pid 
--with-http_ssl_module
```
뭘 해야 할 지 모를 때는 <br>
**--help** 플래그를 붙인다. 어떻게 환경설정을 해야 할 지 상세히 설명 해준다. <br>
혹은 웹사이트 방문 http://nginx.org/en/docs/configure.html

### 3). 컴파일
컴파일 하기 위해서는 C, C++ 컴파일러가 필요하다. 
```
# Ubuntu
apt-get install build-essential
# CentOS
yum groupinstall "Development Tools"
```
```
# 컴파일 명령어
make

# 설치 명령어
make install
```
### 4). 서비스 등록
Nginx를 편리하게 이용하기 위해서 서비스를 등록 할 수 있다.

#### systemd
```
- start & restart
- stop
- reload (configuration)
```
기존에 만들어진 스크립트를 사용하여 손쉽게 등록 할 수 있다. <br><br>
https://www.nginx.com/resources/wiki/start/topics/examples/initscripts/ <br>
```
systemctl start nginx
systemctl stop nginx
systemctl status nginx (상태 조회)
systemctl enable nginx (symlink 생성)
```
symlink를 생성하면 운영체제를 재시작 시켜줘야한다. 
```
# Ubuntu
reboot
```
## 문법
Nginx의 소스코드를 작성하기 위해서 규약(Term)을 이해해야한다.

### Context
```conf
# /etc/nginx/nginx.conf (default)

events {

}

http {
  
  # 기본적으로 제공되는 타입으로 지정하고 싶으면
  include mime.types;
  
  # 개별로 지정하고 싶으면
  types {
    
    text/html;
    text/css;
    
    ...
  }

  server {
    
    listen      포트;
    server_name 도메인;
    root        공개루트 경로

    location {
      ...
    }
  }
}
```
Context는 일반적인 프로그래밍 문법의 Scope 개념과 동일하다. <br>
- http 컨텍스트에는 http와 관련된 것들을 기술하며 
- server 컨텍스트에는 서버 가상호스트 관련 한 것들을 기술한다.
- location 컨텍스트에는 부모 서버로 접근하는 요청들에 관련해 기술한다.
<br><br>
문법 오류를 검사는 아래 명령어로 수행한다.
```
nginx -t
```

### Directive



## 참조 (Reference)
http://nginx.org/ <br>
https://ko.wikipedia.org/wiki/Nginx <br>
https://opentutorials.org/module/384/3462
