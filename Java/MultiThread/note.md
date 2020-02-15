# 멀티스레드 (MultiThread)
updated 2020.02.15 <br>
## 개요 (Summary)
```java
Thread thread = new Thread(Runnable tartget);
```
하나의 프로세스에서 여러 작업을 동시에 수행하기 위한 기능.
## 구현방법
- Runnable 직접 생성
```java
Thread thread = new Thread(Runnable target);
```
- Thread 하위 클래스로부터 생성
```java
class ThreadImpl implements Runnable {
  @Override
  public void run() {
    ...
  }
}
```
## 스레드 풀(Thread Pool)
병렬 작업처리를 작업 큐에서 처리 할 수 있도록 자바는 java.util.concurrent 패키지의 ExecutorService 인터페이스와 Executors 클래스를 제공한다. <br>

|메소드명|초기 스레드 수| 코어 스레드 수|최대 스레드 수|
|---|---|---|---|
|newCachedThreadPool()|0|0|Integer.MAX_VALUE|
|newFixedThreadPool(int n Threads)|0|nThreads|nThreads|
## 스레드 명칭(Thread Name)
스레드는 고유의 이름을 가지고 있다. 로깅 할 때 유용하게 사용함.
```java
...
@Overirde
public void run() {
  setName("Thread-A")
}
```
```java
thread.getName(이름);
thread.setName(이름);
```

## 참조 (Reference)