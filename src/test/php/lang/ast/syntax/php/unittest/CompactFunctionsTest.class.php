<?php namespace lang\ast\syntax\php\unittest;

use lang\ast\unittest\emit\EmittingTest;

class CompactFunctionsTest extends EmittingTest {

  #[@test]
  public function with_scalar() {
    $r= $this->run('class <T> {
      public fn run() => "test";
    }');
    $this->assertEquals('test', $r);
  }

  #[@test]
  public function with_property() {
    $r= $this->run('class <T> {
      private $id= "test";

      public fn run() => $this->id;
    }');
    $this->assertEquals('test', $r);
  }

  #[@test]
  public function combined_with_argument_promotion() {
    $r= $this->run('class <T> {
      public fn withId(private $id) => $this;
      public fn id() => $this->id;

      public function run() {
        return $this->withId("test")->id();
      }
    }');
    $this->assertEquals('test', $r);
  }
}