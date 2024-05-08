<?php 

namespace App\Models;

class MyPage
{

    public function make_links($url, $curpage, $butnum = 2)
    {

      $curpage = $curpage ? (int)$curpage : 1;

      $start = $curpage - $butnum;
      $end = $curpage + $butnum;

      if($start < 1){$start = 1;}
     
      $buttons = array();
      $buttons[] = [
        'First',
        preg_replace('/page=[0-9]+/', 'page=1', $url),
          0
        ];

        $num =$curpage + 1;
     for ($i=$start; $i <= $end; $i++) { 
      # code...
      $myurl = preg_replace('/page=[0-9]+/', 'page='.$i, $url);
      $active = 0;
      if($i == $curpage){$active = 1;}
      $buttons[] = [$i, $myurl, $active];
      $num = $i;
     }
     $buttons[] = [
      'Next <i class="fa fa-chevron-right"></i>',
      preg_replace('/page=[0-9]+/', 'page='.($num + $butnum), $url),
        0
      ];
     return $buttons;
    }
}