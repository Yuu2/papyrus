## 싱글톤(Singleton) 패턴
updated 2019.12.31
```
public class Box {

  /**
   * 1. 생성자 외부에서 호출 할 수 없도록 private 제한.
   * 2. 자기 자신의 정적 필드를 선언 하고 자신의 객체를 생성해 초기화.
   */
  private static Box box = new Box();

  public Box() {}
   
  static Box get() {
    return box;
  }
}

```
단 하나만의 객체를 만들도록 보장해햐 하는 경우. 이 객체를 싱글톤(Singleton)이라고 한다.
```
public class Main {
  public static void main(String[] args) {

    Box box1 = Box.get();
    Box box2 = Box.get();

    if(box1 == box2)
      System.out.println("같은 객체 입니다.");
    else
      System.out.println("다른 객체 입니다.");
  }
}
```