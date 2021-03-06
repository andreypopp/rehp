<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Weak.php
 */

namespace Rehack;

final class Weak {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Array_ = Array_::get();
    $Obj = Obj::get();
    $Pervasives = Pervasives::get();
    $Sys = Sys::get();
    $Invalid_argument = Invalid_argument::get();
    $Not_found = Not_found::get();
    Weak::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Weak;
    return $memoized;
  }

  /**
   * Performs module load operation. May have side effects.
   */
  private static function load($joo_global_object) {
    

    $runtime = $joo_global_object->jsoo_runtime;
    $caml_arity_test = $runtime->caml_arity_test;
    $ArrayLiteral = $runtime->ArrayLiteral;
    $caml_check_bound = $runtime->caml_check_bound;
    $caml_make_vect = $runtime->caml_make_vect;
    $caml_mod = $runtime->caml_mod;
    $caml_new_string = $runtime->caml_new_string;
    $caml_obj_truncate = $runtime->caml_obj_truncate;
    $caml_weak_blit = $runtime->caml_weak_blit;
    $caml_weak_check = $runtime->caml_weak_check;
    $caml_weak_create = $runtime->caml_weak_create;
    $caml_weak_get = $runtime->caml_weak_get;
    $caml_weak_get_copy = $runtime->caml_weak_get_copy;
    $caml_weak_set = $runtime->caml_weak_set;
    $caml_call1 = function($f, $a0) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 1
        ? $f($a0)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0)));
    };
    $caml_call2 = function($f, $a0, $a1) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 2
        ? $f($a0, $a1)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0, $a1)));
    };
    $caml_call3 = function($f, $a0, $a1, $a2) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 3
        ? $f($a0, $a1, $a2)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0, $a1, $a2)));
    };
    $caml_call5 = function($f, $a0, $a1, $a2, $a3, $a4) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 5
        ? $f($a0, $a1, $a2, $a3, $a4)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0, $a1, $a2, $a3, $a4)));
    };
    $global_data = $runtime->caml_get_global_data();
    $cst_Weak_Make_hash_bucket_cannot_grow_more = $caml_new_string(
      "Weak.Make: hash bucket cannot grow more"
    );
    $cst_Weak_fill = $caml_new_string("Weak.fill");
    $Pervasives = $global_data->Pervasives;
    $Sys = $global_data->Sys;
    $Array = $global_data->Array;
    $Not_found = $global_data->Not_found;
    $Invalid_argument = $global_data->Invalid_argument;
    $length = function($x) {return $x->length - 1 - 2 | 0;};
    $fill = function($ar, $ofs, $len, $x) use ($Invalid_argument,$caml_weak_set,$cst_Weak_fill,$length,$runtime) {
      if (0 <= $ofs) {
        if (0 <= $len) {
          if (! ($length($ar) < ($ofs + $len | 0))) {
            $sD = ($ofs + $len | 0) + -1 | 0;
            if (! ($sD < $ofs)) {
              $i = $ofs;
              for (;;) {
                $caml_weak_set($ar, $i, $x);
                $sE = $i + 1 | 0;
                if ($sD !== $i) {$i = $sE;continue;}
                break;
              }
            }
            return 0;
          }
        }
      }
      throw $runtime->caml_wrap_thrown_exception(
              V(0, $Invalid_argument, $cst_Weak_fill)
            );
    };
    $Make = function($H) use ($Array,$Not_found,$Pervasives,$Sys,$caml_call1,$caml_call2,$caml_call3,$caml_call5,$caml_check_bound,$caml_make_vect,$caml_mod,$caml_obj_truncate,$caml_weak_blit,$caml_weak_check,$caml_weak_create,$caml_weak_get,$caml_weak_get_copy,$caml_weak_set,$cst_Weak_Make_hash_bucket_cannot_grow_more,$length,$runtime) {
      $add_aux = new Ref();
      $weak_create = function($sC) use ($caml_weak_create) {
        return $caml_weak_create($sC);
      };
      $emptybucket = $weak_create(0);
      $get_index = function($t, $h) use ($Pervasives,$caml_mod) {
        return $caml_mod($h & $Pervasives[7], $t[1]->length - 1);
      };
      $limit = 7;
      $create = function($sz) use ($Sys,$caml_make_vect,$emptybucket,$limit) {
        $sz__0 = 7 <= $sz ? $sz : (7);
        $sz__1 = $Sys[14] < $sz__0 ? $Sys[14] : ($sz__0);
        return V(
          0,
          $caml_make_vect($sz__1, $emptybucket),
          $caml_make_vect($sz__1, V(0)),
          $limit,
          0,
          0
        );
      };
      $clear = function($t) use ($caml_check_bound,$emptybucket,$limit) {
        $sA = $t[1]->length - 1 + -1 | 0;
        $sz = 0;
        if (! ($sA < 0)) {
          $i = $sz;
          for (;;) {
            $caml_check_bound($t[1], $i)[$i + 1] = $emptybucket;
            $caml_check_bound($t[2], $i)[$i + 1] = V(0);
            $sB = $i + 1 | 0;
            if ($sA !== $i) {$i = $sB;continue;}
            break;
          }
        }
        $t[3] = $limit;
        $t[4] = 0;
        return 0;
      };
      $fold = function($f, $t, $init) use ($Array,$caml_call2,$caml_call3,$caml_weak_get,$length) {
        $fold_bucket = function($i, $b, $accu) use ($caml_call2,$caml_weak_get,$f,$length) {
          $i__0 = $i;
          $accu__0 = $accu;
          for (;;) {
            if ($length($b) <= $i__0) {return $accu__0;}
            $match = $caml_weak_get($b, $i__0);
            if ($match) {
              $v = $match[1];
              $accu__1 = $caml_call2($f, $v, $accu__0);
              $i__1 = $i__0 + 1 | 0;
              $i__0 = $i__1;
              $accu__0 = $accu__1;
              continue;
            }
            $i__2 = $i__0 + 1 | 0;
            $i__0 = $i__2;
            continue;
          }
        };
        $su = $t[1];
        $sv = 0;
        $sw = function($sx, $sy) use ($fold_bucket,$sv) {
          return $fold_bucket($sv, $sx, $sy);
        };
        return $caml_call3($Array[18], $sw, $su, $init);
      };
      $iter = function($f, $t) use ($Array,$caml_call1,$caml_call2,$caml_weak_get,$length) {
        $iter_bucket = function($i, $b) use ($caml_call1,$caml_weak_get,$f,$length) {
          $i__0 = $i;
          for (;;) {
            if ($length($b) <= $i__0) {return 0;}
            $match = $caml_weak_get($b, $i__0);
            if ($match) {
              $v = $match[1];
              $caml_call1($f, $v);
              $i__1 = $i__0 + 1 | 0;
              $i__0 = $i__1;
              continue;
            }
            $i__2 = $i__0 + 1 | 0;
            $i__0 = $i__2;
            continue;
          }
        };
        $sq = $t[1];
        $sr = 0;
        $ss = function($st) use ($iter_bucket,$sr) {
          return $iter_bucket($sr, $st);
        };
        return $caml_call2($Array[13], $ss, $sq);
      };
      $iter_weak = function($f, $t) use ($Array,$caml_call2,$caml_call3,$caml_check_bound,$caml_weak_check,$length) {
        $iter_bucket = function($i, $j, $b) use ($caml_call3,$caml_check_bound,$caml_weak_check,$f,$length,$t) {
          $i__0 = $i;
          for (;;) {
            if ($length($b) <= $i__0) {return 0;}
            $match = $caml_weak_check($b, $i__0);
            if (0 === $match) {$i__1 = $i__0 + 1 | 0;$i__0 = $i__1;continue;}
            $caml_call3($f, $b, $caml_check_bound($t[2], $j)[$j + 1], $i__0);
            $i__2 = $i__0 + 1 | 0;
            $i__0 = $i__2;
            continue;
          }
        };
        $sl = $t[1];
        $sm = 0;
        $sn = function($so, $sp) use ($iter_bucket,$sm) {
          return $iter_bucket($sm, $so, $sp);
        };
        return $caml_call2($Array[14], $sn, $sl);
      };
      $count_bucket = function($i, $b, $accu) use ($caml_weak_check,$length) {
        $i__0 = $i;
        $accu__0 = $accu;
        for (;;) {
          if ($length($b) <= $i__0) {return $accu__0;}
          $sk = $caml_weak_check($b, $i__0) ? 1 : (0);
          $accu__1 = $accu__0 + $sk | 0;
          $i__1 = $i__0 + 1 | 0;
          $i__0 = $i__1;
          $accu__0 = $accu__1;
          continue;
        }
      };
      $count = function($t) use ($Array,$caml_call3,$count_bucket) {
        $se = 0;
        $sf = $t[1];
        $sg = 0;
        $sh = function($si, $sj) use ($count_bucket,$sg) {
          return $count_bucket($sg, $si, $sj);
        };
        return $caml_call3($Array[18], $sh, $sf, $se);
      };
      $next_sz = function($n) use ($Pervasives,$Sys,$caml_call2) {
        return $caml_call2(
          $Pervasives[4],
          ((3 * $n | 0) / 2 | 0) + 3 |
            0,
          $Sys[14]
        );
      };
      $prev_sz = function($n) {
        return ((($n + -3 | 0) * 2 | 0) + 2 | 0) / 3 | 0;
      };
      $test_shrink_bucket = function($t) use ($caml_check_bound,$caml_mod,$caml_obj_truncate,$caml_weak_blit,$caml_weak_check,$count_bucket,$emptybucket,$length,$prev_sz) {
        $r7 = $t[5];
        $bucket = $caml_check_bound($t[1], $r7)[$r7 + 1];
        $r8 = $t[5];
        $hbucket = $caml_check_bound($t[2], $r8)[$r8 + 1];
        $len = $length($bucket);
        $prev_len = $prev_sz($len);
        $live = $count_bucket(0, $bucket, 0);
        if ($live <= $prev_len) {
          $loop = function($i, $j) use ($bucket,$caml_check_bound,$caml_weak_blit,$caml_weak_check,$hbucket,$prev_len) {
            $i__0 = $i;
            $j__0 = $j;
            for (;;) {
              $sc = $prev_len <= $j__0 ? 1 : (0);
              if ($sc) {
                if ($caml_weak_check($bucket, $i__0)) {
                  $i__1 = $i__0 + 1 | 0;
                  $i__0 = $i__1;
                  continue;
                }
                if ($caml_weak_check($bucket, $j__0)) {
                  $caml_weak_blit($bucket, $j__0, $bucket, $i__0, 1);
                  $sd = $caml_check_bound($hbucket, $j__0)[$j__0 + 1];
                  $caml_check_bound($hbucket, $i__0)[$i__0 + 1] = $sd;
                  $j__1 = $j__0 + -1 | 0;
                  $i__2 = $i__0 + 1 | 0;
                  $i__0 = $i__2;
                  $j__0 = $j__1;
                  continue;
                }
                $j__2 = $j__0 + -1 | 0;
                $j__0 = $j__2;
                continue;
              }
              return $sc;
            }
          };
          $loop(0, $length($bucket) + -1 | 0);
          if (0 === $prev_len) {
            $r9 = $t[5];
            $caml_check_bound($t[1], $r9)[$r9 + 1] = $emptybucket;
            $r_ = $t[5];
            $caml_check_bound($t[2], $r_)[$r_ + 1] = V(0);
          }
          else {
            $caml_obj_truncate($bucket, $prev_len + 2 | 0);
            $caml_obj_truncate($hbucket, $prev_len);
          }
          $sa = $t[3] < $len ? 1 : (0);
          $sb = $sa ? $prev_len <= $t[3] ? 1 : (0) : ($sa);
          if ($sb) {$t[4] = $t[4] + -1 | 0;}
        }
        $t[5] = $caml_mod($t[5] + 1 | 0, $t[1]->length - 1);
        return 0;
      };
      $resize = function($t) use ($Pervasives,$add_aux,$caml_check_bound,$caml_mod,$caml_weak_blit,$create,$get_index,$iter_weak,$next_sz) {
        $oldlen = $t[1]->length - 1;
        $newlen = $next_sz($oldlen);
        if ($oldlen < $newlen) {
          $newt = $create($newlen);
          $add_weak = function($ob, $oh, $oi) use ($add_aux,$caml_check_bound,$caml_weak_blit,$get_index,$newt) {
            $setter = function($nb, $ni, $param) use ($caml_weak_blit,$ob,$oi) {
              return $caml_weak_blit($ob, $oi, $nb, $ni, 1);
            };
            $h = $caml_check_bound($oh, $oi)[$oi + 1];
            return $add_aux->contents(
              $newt,
              $setter,
              0,
              $h,
              $get_index($newt, $h)
            );
          };
          $iter_weak($add_weak, $t);
          $t[1] = $newt[1];
          $t[2] = $newt[2];
          $t[3] = $newt[3];
          $t[4] = $newt[4];
          $t[5] = $caml_mod($t[5], $newt[1]->length - 1);
          return 0;
        }
        $t[3] = $Pervasives[7];
        $t[4] = 0;
        return 0;
      };
      $_ = $add_aux->contents =
        function($t, $setter, $d, $h, $index) use ($Array,$Pervasives,$Sys,$caml_call1,$caml_call2,$caml_call3,$caml_call5,$caml_check_bound,$caml_make_vect,$caml_weak_blit,$caml_weak_check,$cst_Weak_Make_hash_bucket_cannot_grow_more,$length,$resize,$test_shrink_bucket,$weak_create) {
          $bucket = $caml_check_bound($t[1], $index)[$index + 1];
          $hashes = $caml_check_bound($t[2], $index)[$index + 1];
          $sz = $length($bucket);
          $loop = function($i) use ($Array,$Pervasives,$Sys,$bucket,$caml_call1,$caml_call2,$caml_call3,$caml_call5,$caml_check_bound,$caml_make_vect,$caml_weak_blit,$caml_weak_check,$cst_Weak_Make_hash_bucket_cannot_grow_more,$d,$h,$hashes,$index,$resize,$setter,$sz,$t,$test_shrink_bucket,$weak_create) {
            $i__0 = $i;
            for (;;) {
              if ($sz <= $i__0) {
                $newsz = $caml_call2(
                  $Pervasives[4],
                  ((3 * $sz | 0) / 2 | 0) + 3 |
                    0,
                  $Sys[14] - 2 |
                    0
                );
                if ($newsz <= $sz) {
                  $caml_call1(
                    $Pervasives[2],
                    $cst_Weak_Make_hash_bucket_cannot_grow_more
                  );
                }
                $newbucket = $weak_create($newsz);
                $newhashes = $caml_make_vect($newsz, 0);
                $caml_weak_blit($bucket, 0, $newbucket, 0, $sz);
                $caml_call5($Array[10], $hashes, 0, $newhashes, 0, $sz);
                $caml_call3($setter, $newbucket, $sz, $d);
                $caml_check_bound($newhashes, $sz)[$sz + 1] = $h;
                $caml_check_bound($t[1], $index)[$index + 1] = $newbucket;
                $caml_check_bound($t[2], $index)[$index + 1] = $newhashes;
                $r3 = $sz <= $t[3] ? 1 : (0);
                $r4 = $r3 ? $t[3] < $newsz ? 1 : (0) : ($r3);
                if ($r4) {
                  $t[4] = $t[4] + 1 | 0;
                  $i__1 = 0;
                  for (;;) {
                    $test_shrink_bucket($t);
                    $r6 = $i__1 + 1 | 0;
                    if (2 !== $i__1) {$i__1 = $r6;continue;}
                    break;
                  }
                }
                $r5 = (($t[1]->length - 1) / 2 | 0) < $t[4] ? 1 : (0);
                return $r5 ? $resize($t) : ($r5);
              }
              if ($caml_weak_check($bucket, $i__0)) {
                $i__2 = $i__0 + 1 | 0;
                $i__0 = $i__2;
                continue;
              }
              $caml_call3($setter, $bucket, $i__0, $d);
              return $caml_check_bound($hashes, $i__0)[$i__0 + 1] = $h;
            }
          };
          return $loop(0);
        };
      $add = function($t, $d) use ($H,$add_aux,$caml_call1,$caml_weak_set,$get_index) {
        $h = $caml_call1($H[2], $d);
        $rY = $get_index($t, $h);
        $rZ = V(0, $d);
        return $add_aux->contents(
          $t,
          function($r2, $r1, $r0) use ($caml_weak_set) {
            return $caml_weak_set($r2, $r1, $r0);
          },
          $rZ,
          $h,
          $rY
        );
      };
      $find_or = function($t, $d, $ifnotfound) use ($H,$caml_call1,$caml_call2,$caml_check_bound,$caml_weak_get,$caml_weak_get_copy,$get_index,$length) {
        $h = $caml_call1($H[2], $d);
        $index = $get_index($t, $h);
        $bucket = $caml_check_bound($t[1], $index)[$index + 1];
        $hashes = $caml_check_bound($t[2], $index)[$index + 1];
        $sz = $length($bucket);
        $loop = function($i) use ($H,$bucket,$caml_call2,$caml_check_bound,$caml_weak_get,$caml_weak_get_copy,$d,$h,$hashes,$ifnotfound,$index,$sz) {
          $i__0 = $i;
          for (;;) {
            if ($sz <= $i__0) {return $caml_call2($ifnotfound, $h, $index);}
            if ($h === $caml_check_bound($hashes, $i__0)[$i__0 + 1]) {
              $match = $caml_weak_get_copy($bucket, $i__0);
              if ($match) {
                $v = $match[1];
                if ($caml_call2($H[1], $v, $d)) {
                  $match__0 = $caml_weak_get($bucket, $i__0);
                  if ($match__0) {$v__0 = $match__0[1];return $v__0;}
                  $i__1 = $i__0 + 1 | 0;
                  $i__0 = $i__1;
                  continue;
                }
              }
              $i__2 = $i__0 + 1 | 0;
              $i__0 = $i__2;
              continue;
            }
            $i__3 = $i__0 + 1 | 0;
            $i__0 = $i__3;
            continue;
          }
        };
        return $loop(0);
      };
      $merge = function($t, $d) use ($add_aux,$caml_weak_set,$find_or) {
        return $find_or(
          $t,
          $d,
          function($h, $index) use ($add_aux,$caml_weak_set,$d,$t) {
            $rU = V(0, $d);
            $add_aux->contents(
              $t,
              function($rX, $rW, $rV) use ($caml_weak_set) {
                return $caml_weak_set($rX, $rW, $rV);
              },
              $rU,
              $h,
              $index
            );
            return $d;
          }
        );
      };
      $find = function($t, $d) use ($Not_found,$find_or,$runtime) {
        return $find_or(
          $t,
          $d,
          function($h, $index) use ($Not_found,$runtime) {
            throw $runtime->caml_wrap_thrown_exception($Not_found);
          }
        );
      };
      $find_opt = function($t, $d) use ($H,$caml_call1,$caml_call2,$caml_check_bound,$caml_weak_get,$caml_weak_get_copy,$get_index,$length) {
        $h = $caml_call1($H[2], $d);
        $index = $get_index($t, $h);
        $bucket = $caml_check_bound($t[1], $index)[$index + 1];
        $hashes = $caml_check_bound($t[2], $index)[$index + 1];
        $sz = $length($bucket);
        $loop = function($i) use ($H,$bucket,$caml_call2,$caml_check_bound,$caml_weak_get,$caml_weak_get_copy,$d,$h,$hashes,$sz) {
          $i__0 = $i;
          for (;;) {
            if ($sz <= $i__0) {return 0;}
            if ($h === $caml_check_bound($hashes, $i__0)[$i__0 + 1]) {
              $match = $caml_weak_get_copy($bucket, $i__0);
              if ($match) {
                $v = $match[1];
                if ($caml_call2($H[1], $v, $d)) {
                  $v__0 = $caml_weak_get($bucket, $i__0);
                  if ($v__0) {return $v__0;}
                  $i__1 = $i__0 + 1 | 0;
                  $i__0 = $i__1;
                  continue;
                }
              }
              $i__2 = $i__0 + 1 | 0;
              $i__0 = $i__2;
              continue;
            }
            $i__3 = $i__0 + 1 | 0;
            $i__0 = $i__3;
            continue;
          }
        };
        return $loop(0);
      };
      $find_shadow = function($t, $d, $iffound, $ifnotfound) use ($H,$caml_call1,$caml_call2,$caml_check_bound,$caml_weak_get_copy,$get_index,$length) {
        $h = $caml_call1($H[2], $d);
        $index = $get_index($t, $h);
        $bucket = $caml_check_bound($t[1], $index)[$index + 1];
        $hashes = $caml_check_bound($t[2], $index)[$index + 1];
        $sz = $length($bucket);
        $loop = function($i) use ($H,$bucket,$caml_call2,$caml_check_bound,$caml_weak_get_copy,$d,$h,$hashes,$iffound,$ifnotfound,$sz) {
          $i__0 = $i;
          for (;;) {
            if ($sz <= $i__0) {return $ifnotfound;}
            if ($h === $caml_check_bound($hashes, $i__0)[$i__0 + 1]) {
              $match = $caml_weak_get_copy($bucket, $i__0);
              if ($match) {
                $v = $match[1];
                if ($caml_call2($H[1], $v, $d)) {
                  return $caml_call2($iffound, $bucket, $i__0);
                }
              }
              $i__1 = $i__0 + 1 | 0;
              $i__0 = $i__1;
              continue;
            }
            $i__2 = $i__0 + 1 | 0;
            $i__0 = $i__2;
            continue;
          }
        };
        return $loop(0);
      };
      $remove = function($t, $d) use ($caml_weak_set,$find_shadow) {
        $rT = 0;
        return $find_shadow(
          $t,
          $d,
          function($w, $i) use ($caml_weak_set) {
            return $caml_weak_set($w, $i, 0);
          },
          $rT
        );
      };
      $mem = function($t, $d) use ($find_shadow) {
        $rS = 0;
        return $find_shadow($t, $d, function($w, $i) {return 1;}, $rS);
      };
      $find_all = function($t, $d) use ($H,$caml_call1,$caml_call2,$caml_check_bound,$caml_weak_get,$caml_weak_get_copy,$get_index,$length) {
        $h = $caml_call1($H[2], $d);
        $index = $get_index($t, $h);
        $bucket = $caml_check_bound($t[1], $index)[$index + 1];
        $hashes = $caml_check_bound($t[2], $index)[$index + 1];
        $sz = $length($bucket);
        $loop = function($i, $accu) use ($H,$bucket,$caml_call2,$caml_check_bound,$caml_weak_get,$caml_weak_get_copy,$d,$h,$hashes,$sz) {
          $i__0 = $i;
          $accu__0 = $accu;
          for (;;) {
            if ($sz <= $i__0) {return $accu__0;}
            if ($h === $caml_check_bound($hashes, $i__0)[$i__0 + 1]) {
              $match = $caml_weak_get_copy($bucket, $i__0);
              if ($match) {
                $v = $match[1];
                if ($caml_call2($H[1], $v, $d)) {
                  $match__0 = $caml_weak_get($bucket, $i__0);
                  if ($match__0) {
                    $v__0 = $match__0[1];
                    $accu__1 = V(0, $v__0, $accu__0);
                    $i__1 = $i__0 + 1 | 0;
                    $i__0 = $i__1;
                    $accu__0 = $accu__1;
                    continue;
                  }
                  $i__2 = $i__0 + 1 | 0;
                  $i__0 = $i__2;
                  continue;
                }
              }
              $i__3 = $i__0 + 1 | 0;
              $i__0 = $i__3;
              continue;
            }
            $i__4 = $i__0 + 1 | 0;
            $i__0 = $i__4;
            continue;
          }
        };
        return $loop(0, 0);
      };
      $stats = function($t) use ($Array,$caml_call2,$caml_call3,$caml_check_bound,$count,$length,$runtime) {
        $len = $t[1]->length - 1;
        $lens = $caml_call2($Array[15], $length, $t[1]);
        $rG = function($rR, $rQ) use ($runtime) {
          return $runtime->caml_int_compare($rR, $rQ);
        };
        $caml_call2($Array[25], $rG, $lens);
        $rH = 0;
        $rI = function($rP, $rO) {return $rP + $rO | 0;};
        $totlen = $caml_call3($Array[17], $rI, $rH, $lens);
        $rJ = $len + -1 | 0;
        $rL = $len / 2 | 0;
        $rK = $caml_check_bound($lens, $rJ)[$rJ + 1];
        $rM = $caml_check_bound($lens, $rL)[$rL + 1];
        $rN = $caml_check_bound($lens, 0)[1];
        return V(0, $len, $count($t), $totlen, $rN, $rM, $rK);
      };
      return V(
        0,
        $create,
        $clear,
        $merge,
        $add,
        $remove,
        $find,
        $find_opt,
        $find_all,
        $mem,
        $iter,
        $fold,
        $count,
        $stats
      );
    };
    $rm = function($rF, $rE, $rD, $rC, $rB) use ($caml_weak_blit) {
      return $caml_weak_blit($rF, $rE, $rD, $rC, $rB);
    };
    $rn = function($rA, $rz) use ($caml_weak_check) {
      return $caml_weak_check($rA, $rz);
    };
    $ro = function($ry, $rx) use ($caml_weak_get_copy) {
      return $caml_weak_get_copy($ry, $rx);
    };
    $rp = function($rw, $rv) use ($caml_weak_get) {
      return $caml_weak_get($rw, $rv);
    };
    $rq = function($ru, $rt, $rs) use ($caml_weak_set) {
      return $caml_weak_set($ru, $rt, $rs);
    };
    $Weak = V(
      0,
      function($rr) use ($caml_weak_create) {return $caml_weak_create($rr);},
      $length,
      $rq,
      $rp,
      $ro,
      $rn,
      $fill,
      $rm,
      $Make
    );
    
    $runtime->caml_register_global(7, $Weak, "Weak");

  }
}