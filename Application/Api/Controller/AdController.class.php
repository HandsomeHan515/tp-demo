<?php
namespace Api\Controller;
use Think\Controller;

class AdController extends Controller {
  public function getList() {
    $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    $arr2 = [];
    $this->ajaxReturn(array(
      'status' => 0,
      'data' => $arr
    ));
  }
}