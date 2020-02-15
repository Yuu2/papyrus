# 입출력 (I/O)
updated 2020.02.15

## 개요(Summary)
자바는 데이터를 스트림(Stream)을 통해 입출려 되며 단일 방향으로 진행된다.
프로그램이 데이터를 입력 받을 때에는 입력 스트림, 출력 할 때에는 출력 스트림이라고 한다.
자바는 기본적으로 java.io 패키지를 제공하고 있다.
## FileReader
**텍스트 파일**을 프로그램으로 읽을 때 사용하는 문자 기반 스트림이다.
```java
FileReader fr = new FileReader(파일경로)

int readCharNo;

char[] buffer = new char[100];

while((readCharNo = fr.read(buffer)) != -1) {
  // buffer 문자열 처리
}

fr.close();
```
예제에는 매개변수로 문자열을 건냈지만 **파일**객체를 건낼 수도 있다.
```java
File file = new File(파일 경로)
```
## BufferedReader
메모리 버퍼를 활용하여 프로그램의 입력을 향상시키기 위한 문자열 기반 보조스트림이다.
```java
BufferedReader br = new BufferedReader(문자입력스트림);
```
### readLine()
BufferedReader는 readLine() 메소드를 지니고 있는데 캐리지리턴(\r), 라인피드(\n)로 구분된 행단위의 문자열을 한꺼번에 읽을 수 있다.

## 