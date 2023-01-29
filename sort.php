<?php
/**
 * 選択ソート
 * 計算量：O(n^2)
 * 好きな理由：人間が考えた場合に、理解しやすいシンプルな実装の為
 * @param array $arr 並び替え対象配列
 * @return array 並び替えられた配列
 */
function selectionSort($arr)
{
    // 配列の長さを取得する
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        // 未ソートの配列から最小値を見つける
        $min_idx = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$j] < $arr[$min_idx]) {
                $min_idx = $j;
            }
        }
        // 最小値を先頭の要素と交換する
        $temp = $arr[$min_idx];
        $arr[$min_idx] = $arr[$i];
        $arr[$i] = $temp;
    }
    return $arr;
}

/**
 * クイックソート
 * 計算量：O(nLogn)
 * 好きな理由：外部メモリをする必要がなく、シンプルな実装となる為
 * @param array $arr 並べ替え対象配列
 * @return array 並べ替えられた配列
 */
function quickSort(array $arr)
{
    $length = count($arr);
    // 配列の要素数が1以下ならそのまま返す
    if ($length <= 1) {
        return $arr;
    }
    // ピボットを配列の先頭の要素に設定
    $pivot = $arr[0];
    // 小さい値用の配列と大きい値用の配列を用意
    $left = $right = array();
    // 配列をピボットの値で分割
    for ($i = 1; $i < $length; $i++) {
        if ($arr[$i] < $pivot) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }
    // 小さい値用の配列と大きい値用の配列を再帰的にクイックソート
    return array_merge(quickSort($left), array($pivot), quickSort($right));
}

// ソートアルゴリズムの実行（動作検証用）
testSort();
function testSort()
{
    /**
     * テスト結果の出力
     *
     * @param int $n テストケース番号
     * @param bool $is_res テスト結果
     * @return void
     */
    function testResult($n, $is_res)
    {
        echo 'テストケース ' . $n .  ' ' . ($is_res ? 'passed' : 'Failed') . PHP_EOL;
    }

    // 選択ソートのテスト実行
    echo ('>>選択ソートテスト開始' . PHP_EOL);

    // 空の配列をテストする
    $arr = array();
    $sortedArr = selectionSort($arr);
    testResult(1, empty($sortedArr));

    // 長さ1の配列をテストする
    $arr = array(1);
    $sortedArr = selectionSort($arr);
    testResult(2, $sortedArr == $arr);

    // 長さ2の配列をテストする
    $arr = array(2, 1);
    $sortedArr = selectionSort($arr);
    testResult(3, $sortedArr == array(1, 2));

    // 逆順に並んだ配列をテストする
    $arr = array(3, 2, 1);
    $sortedArr = selectionSort($arr);
    testResult(4, $sortedArr == array(1, 2, 3));

    // ランダムな配列をテストする
    $arr = array(2, 3, 1);
    $sortedArr = selectionSort($arr);
    testResult(5, $sortedArr == array(1, 2, 3));

    // 既にソートされた配列をテストする
    $arr = array(1, 2, 3);
    $sortedArr = selectionSort($arr);
    testResult(6, $sortedArr == $arr);

    // 要素が重複する配列をテストする
    $arr = array(2, 2, 1);
    $sortedArr = selectionSort($arr);
    testResult(7, $sortedArr == array(1, 2, 2));

    // 大量のデータを含む配列をテストする
    // paizaで実行するとタイムアウトする
    $arr = array();
    for ($i = 0; $i < 100000; $i++) {
        $arr[] = rand();
    }
    $sortedArr = selectionSort($arr);
    $flag = true;
    for ($i = 0; $i < count($sortedArr) - 1; $i++) {
        if ($sortedArr[$i] > $sortedArr[$i + 1]) {
            $flag = false;
            break;
        }
    }
    testResult(8, $flag);

    echo ('>>選択ソートテスト終了' . PHP_EOL);

    // クイックソートのテスト実行
    echo ('>>クイックソートテスト開始' . PHP_EOL);

    // 空の配列をテストする
    $arr = array();
    $sortedArr = quickSort($arr);
    testResult(1, empty($sortedArr));

    // 長さ1の配列をテストする
    $arr = array(1);
    $sortedArr = quickSort($arr);
    testResult(2, $sortedArr == $arr);

    // 長さ2の配列をテストする
    $arr = array(2, 1);
    $sortedArr = quickSort($arr);
    testResult(3, $sortedArr == array(1, 2));

    // 逆順に並んだ配列をテストする
    $arr = array(3, 2, 1);
    $sortedArr = quickSort($arr);
    testResult(4, $sortedArr == array(1, 2, 3));

    // ランダムな配列をテストする
    $arr = array(2, 3, 1);
    $sortedArr = quickSort($arr);
    testResult(5, $sortedArr == array(1, 2, 3));

    // 既にソートされた配列をテストする
    $arr = array(1, 2, 3);
    $sortedArr = quickSort($arr);
    testResult(6, $sortedArr == $arr);

    // 要素が重複する配列をテストする
    $arr = array(2, 2, 1);
    $sortedArr = quickSort($arr);
    testResult(7, $sortedArr == array(1, 2, 2));

    // 大量のデータを含む配列をテストする
    $arr = array();
    for ($i = 0; $i < 100000; $i++) {
        $arr[] = rand();
    }
    $sortedArr = quickSort($arr);
    $flag = true;
    for ($i = 0; $i < count($sortedArr) - 1; $i++) {
        if ($sortedArr[$i] > $sortedArr[$i + 1]) {
            $flag = false;
            break;
        }
    }
    testResult(8, $flag);

    echo ('>>クイックソートテスト終了' . PHP_EOL);
}
