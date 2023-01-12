<?php
// DB接続
$dbn ='mysql:dbname=engagement_survey;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行
$sql = 'SELECT * FROM answer_table';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>





<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>engagement survey</title>
</head>
<body>
    <!-- 管理者用ページ_回答結果 -->
    <h1>回答結果</h1>
    <div class="admin_wrapper">
        <h2>eNPSスコア</h2>
        <div class="score_wrapper">
            <p>スコア：<span id="GetDataQ1"></span></p>
        </div>

        <h2>eNPSスコアの推移</h2>
        <div class="score_transition_wrapper">
            <div style="display: none;">
                <p>2022年4月：<span id="transitionGetDataQ1_202204"></span></p>
                <p>2022年7月：<span id="transitionGetDataQ1_202207"></span></p>
                <p>2022年10月：<span id="transitionGetDataQ1_202210"></span></p>
            </div>
            <canvas id="chartTransition"></canvas>
        </div>

        <h2>総合満足度</h2>
        <div class="genre_wrapper">
            <p>労働時間：<span id="GetDataQ2"></span></p>
            <p>報酬：<span id="GetDataQ3"></span></p>
            <p>仕事のやりがい：<span id="GetDataQ4"></span></p>
            <p>自己成長：<span id="GetDataQ5"></span></p>
            <p>人間関係：<span id="GetDataQ6"></span></p>
            <p>理念への共感：<span id="GetDataQ7"></span></p>
            <canvas id="chart1"></canvas>
        </div>

        <!-- <h2>強みと弱み</h2>
        <div class="strength_weakness_wrapper">
            <p>――</p>
        </div> -->

        <!-- <h2>属性ごとの満足度</h2>
        <select id="optionBox" onchange="change();">
            <option value="0">選択してください</option>
            <option value="optionFemale">女性</option>
            <option value="optionMale">男性</option>
            <option value="option20">20代</option>
            <option value="option30">30代</option>
            <option value="option40">40代</option>
            <option value="option50">50代</option>
            <option value="optionMatoba">的場店</option>
            <option value="optionJiromaru">次郎丸店</option>
            <option value="optionNurse">看護師</option>
            <option value="optionTherapist">セラピスト</option>
            <option value="optionClerk">事務</option>
            <option value="optionLength1">1年未満</option>
            <option value="optionLength12">1-2年</option>
            <option value="optionLength23">2-3年</option>
            <option value="optionLength3">3年以上</option>
        </select> -->

        <div class="gender_wrapper">
            <div class="gender_female_box" id="genderFemaleBox" style="display:none">
                <h4>女性</h4>
                <p>労働時間：<span id="genderFemaleDataQ2"></span></p>
                <p>報酬：<span id="genderFemaleDataQ3"></span></p>
                <p>仕事のやりがい：<span id="genderFemaleDataQ4"></span></p>
                <p>自己成長：<span id="genderFemaleDataQ5"></span></p>
                <p>人間関係：<span id="genderFemaleDataQ6"></span></p>
                <p>理念への共感：<span id="genderFemaleDataQ7"></span></p>
                <canvas id="chartFemale"></canvas>
            </div>
            <div class="gender_male_box" id="genderMaleBox" style="display:none">
                <h4>男性</h4>
                <p>労働時間：<span id="genderMaleDataQ2"></span></p>
                <p>報酬：<span id="genderMaleDataQ3"></span></p>
                <p>仕事のやりがい：<span id="genderMaleDataQ4"></span></p>
                <p>自己成長：<span id="genderMaleDataQ5"></span></p>
                <p>人間関係：<span id="genderMaleDataQ6"></span></p>
                <p>理念への共感：<span id="genderMaleDataQ7"></span></p>
                <canvas id="chartMale"></canvas>
            </div>
        </div>

        <div class="age_wrapper">
            <div class="age_20_box" id="age20Box" style="display:none">
                <h4>20代</h4>
                <p>労働時間：<span id="age20DataQ2"></span></p>
                <p>報酬：<span id="age20DataQ3"></span></p>
                <p>仕事のやりがい：<span id="age20DataQ4"></span></p>
                <p>自己成長：<span id="age20DataQ5"></span></p>
                <p>人間関係：<span id="age20DataQ6"></span></p>
                <p>理念への共感：<span id="age20DataQ7"></span></p>
                <canvas id="chart20"></canvas>
            </div>
            <div class="age_30_box" id="age30Box" style="display:none">
                <h4>30代</h4>
                <p>労働時間：<span id="age30DataQ2"></span></p>
                <p>報酬：<span id="age30DataQ3"></span></p>
                <p>仕事のやりがい：<span id="age30DataQ4"></span></p>
                <p>自己成長：<span id="age30DataQ5"></span></p>
                <p>人間関係：<span id="age30DataQ6"></span></p>
                <p>理念への共感：<span id="age30DataQ7"></span></p>
                <canvas id="chart30"></canvas>
            </div>
            <div class="age_40_box" id="age40Box" style="display:none">
                <h4>40代</h4>
                <p>労働時間：<span id="age40DataQ2"></span></p>
                <p>報酬：<span id="age40DataQ3"></span></p>
                <p>仕事のやりがい：<span id="age40DataQ4"></span></p>
                <p>自己成長：<span id="age40DataQ5"></span></p>
                <p>人間関係：<span id="age40DataQ6"></span></p>
                <p>理念への共感：<span id="age40DataQ7"></span></p>
                <canvas id="chart40"></canvas>
            </div>
            <div class="age_50_box" id="age50Box" style="display:none">
                <h4>50代</h4>
                <p>労働時間：<span id="age50DataQ2"></span></p>
                <p>報酬：<span id="age50DataQ3"></span></p>
                <p>仕事のやりがい：<span id="age50DataQ4"></span></p>
                <p>自己成長：<span id="age50DataQ5"></span></p>
                <p>人間関係：<span id="age50DataQ6"></span></p>
                <p>理念への共感：<span id="age50DataQ7"></span></p>
                <canvas id="chart50"></canvas>
            </div>
        </div>

        <div class="affiliation_wrapper">
            <div class="affiliation_matoba_box" id="affiliationMatobaBox" style="display:none">
                <h4>的場店</h4>
                <p>労働時間：<span id="affiliationMatobaDataQ2"></span></p>
                <p>報酬：<span id="affiliationMatobaDataQ3"></span></p>
                <p>仕事のやりがい：<span id="affiliationMatobaDataQ4"></span></p>
                <p>自己成長：<span id="affiliationMatobaDataQ5"></span></p>
                <p>人間関係：<span id="affiliationMatobaDataQ6"></span></p>
                <p>理念への共感：<span id="affiliationMatobaDataQ7"></span></p>
                <canvas id="chartMatoba"></canvas>
            </div>
            <div class="affiliation_jiromaru_box" id="affiliationJiromaruBox" style="display:none">
                <h4>次郎丸店</h4>
                <p>労働時間：<span id="affiliationJiromaruDataQ2"></span></p>
                <p>報酬：<span id="affiliationJiromaruDataQ3"></span></p>
                <p>仕事のやりがい：<span id="affiliationJiromaruDataQ4"></span></p>
                <p>自己成長：<span id="affiliationJiromaruDataQ5"></span></p>
                <p>人間関係：<span id="affiliationJiromaruDataQ6"></span></p>
                <p>理念への共感：<span id="affiliationJiromaruDataQ7"></span></p>
                <canvas id="chartJiromaru"></canvas>
            </div>
        </div>

        <div class="occupation_wrapper">
            <div class="occupation_nurse_box" id="occupationNurseBox" style="display:none">
                <h4>看護師</h4>
                <p>労働時間：<span id="occupationNurseDataQ2"></span></p>
                <p>報酬：<span id="occupationNurseDataQ3"></span></p>
                <p>仕事のやりがい：<span id="occupationNurseDataQ4"></span></p>
                <p>自己成長：<span id="occupationNurseDataQ5"></span></p>
                <p>人間関係：<span id="occupationNurseDataQ6"></span></p>
                <p>理念への共感：<span id="occupationNurseDataQ7"></span></p>
                <canvas id="chartNurse"></canvas>
            </div>
            <div class="occupation_therapist_box" id="occupationTherapistBox" style="display:none">
                <h4>セラピスト</h4>
                <p>労働時間：<span id="occupationTherapistDataQ2"></span></p>
                <p>報酬：<span id="occupationTherapistDataQ3"></span></p>
                <p>仕事のやりがい：<span id="occupationTherapistDataQ4"></span></p>
                <p>自己成長：<span id="occupationTherapistDataQ5"></span></p>
                <p>人間関係：<span id="occupationTherapistDataQ6"></span></p>
                <p>理念への共感：<span id="occupationTherapistDataQ7"></span></p>
                <canvas id="chartTherapist"></canvas>
            </div>
            <div class="occupation_clerk_box" id="occupationClerkBox" style="display:none">
                <h4>事務</h4>
                <p>労働時間：<span id="occupationClerkDataQ2"></span></p>
                <p>報酬：<span id="occupationClerkDataQ3"></span></p>
                <p>仕事のやりがい：<span id="occupationClerkDataQ4"></span></p>
                <p>自己成長：<span id="occupationClerkDataQ5"></span></p>
                <p>人間関係：<span id="occupationClerkDataQ6"></span></p>
                <p>理念への共感：<span id="occupationClerkDataQ7"></span></p>
                <canvas id="chartClerk"></canvas>
            </div>
        </div>

        <div class="length_wrapper">
            <div class="length_1_box" id="length1Box" style="display:none">
                <h4>1年未満</h4>
                <p>労働時間：<span id="length1DataQ2"></span></p>
                <p>報酬：<span id="length1DataQ3"></span></p>
                <p>仕事のやりがい：<span id="length1DataQ4"></span></p>
                <p>自己成長：<span id="length1DataQ5"></span></p>
                <p>人間関係：<span id="length1DataQ6"></span></p>
                <p>理念への共感：<span id="length1DataQ7"></span></p>
                <canvas id="chartLength1"></canvas>
            </div>
            <div class="length_12_box" id="length12Box" style="display:none">
                <h4>1-2年</h4>
                <p>労働時間：<span id="length12DataQ2"></span></p>
                <p>報酬：<span id="length12DataQ3"></span></p>
                <p>仕事のやりがい：<span id="length12DataQ4"></span></p>
                <p>自己成長：<span id="length12DataQ5"></span></p>
                <p>人間関係：<span id="length12DataQ6"></span></p>
                <p>理念への共感：<span id="length12DataQ7"></span></p>
                <canvas id="chartLength12"></canvas>
            </div>
            <div class="length_23_box" id="length23Box" style="display:none">
                <h4>2-3年</h4>
                <p>労働時間：<span id="length23DataQ2"></span></p>
                <p>報酬：<span id="length23DataQ3"></span></p>
                <p>仕事のやりがい：<span id="length23DataQ4"></span></p>
                <p>自己成長：<span id="length23DataQ5"></span></p>
                <p>人間関係：<span id="length23DataQ6"></span></p>
                <p>理念への共感：<span id="length23DataQ7"></span></p>
                <canvas id="chartLength23"></canvas>
            </div>
            <div class="length_3_box" id="length3Box" style="display:none">
                <h4>3年以上</h4>
                <p>労働時間：<span id="length3DataQ2"></span></p>
                <p>報酬：<span id="length3DataQ3"></span></p>
                <p>仕事のやりがい：<span id="length3DataQ4"></span></p>
                <p>自己成長：<span id="length3DataQ5"></span></p>
                <p>人間関係：<span id="length3DataQ6"></span></p>
                <p>理念への共感：<span id="length3DataQ7"></span></p>
                <canvas id="chartLength3"></canvas>
            </div>
        </div>

        <h2>属性ごとの比較</h2>
        <select id="comparisonBox" onchange="change();">
            <option value="0">選択してください</option>
            <option value="comparisonGender">性別</option>
            <option value="comparisonAge">年齢</option>
            <option value="comparisonAffiliation">所属</option>
            <option value="comparisonOccupation">職種</option>
            <option value="comparisonLength">勤続年数</option>
        </select>
        <div class="comparison_wrapper">
            <canvas id="chart_comparison1" style="display:none"></canvas>
            <canvas id="chart_comparison2" style="display:none"></canvas>
            <canvas id="chart_comparison3" style="display:none"></canvas>
            <canvas id="chart_comparison4" style="display:none"></canvas>
            <canvas id="chart_comparison5" style="display:none"></canvas>
        </div>

    </div>
    <div class="admin_btn_wrapper">
        <a href="admin.php" class="result_top_btn result_top_btn2">管理画面へ</a>
        <a href="top.php" class="result_top_btn result_top_btn2">TOPへ戻る</a>
    </div>





    <!--------------------------------------------------- js --------------------------------------------------->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const fireAllData = <?= json_encode($result) ?>; //データベース内の全てのデータ
        console.log(fireAllData);



        // -----------------eNPSスコア-----------------
        // すべての回答データの中からQ1のみ取り出す
        const allDataQ1 = []; //Q1のすべての回答

        fireAllData.forEach(elm => {
            console.log(elm); //elmはfireAllDataの中の配列を取得
            const answerQ1 = elm.q1; //すべての回答の中からQ1の値を取得
            allDataQ1.push(answerQ1);
        });
        console.log(allDataQ1);

        // 平均点を取得
        let sumQ1 = allDataQ1.reduce((a, b) => { //回答の値の総和
            return a + b;
        });
        const averageQ1 = (sumQ1 / allDataQ1.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
        console.log(averageQ1);

        // 結果画面への表示
        $("#GetDataQ1").html(averageQ1);





        // -----------------eNPSスコアの推移-----------------

        // -----2022年4月-----
            const transitionGetData_202204 = []; //2022年4月のすべてのデータ
            const transitionGetDataQ1_202204 = []; //2022年4月のQ1のデータ

            fireAllData.forEach(x => {
                if (x.year === "2022年4月") {
                    transitionGetData_202204.push(x);  //2020年を選択した回答者のデータ取り出し
                    const transitionQ1_202204 = x.q1; //2022年4月の中のQ1の値を取得
                    transitionGetDataQ1_202204.push(transitionQ1_202204);
                }
            });
            console.log(transitionGetDataQ1_202204);
            let sumTransitionQ1_202204 = transitionGetDataQ1_202204.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageTransitionQ1_202204 = (sumTransitionQ1_202204 / transitionGetDataQ1_202204.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageTransitionQ1_202204);
            document.getElementById("transitionGetDataQ1_202204").innerHTML = averageTransitionQ1_202204; // 結果画面への表示

            // -----2022年7月-----
            const transitionGetData_202207 = []; //2022年7月のすべてのデータ
            const transitionGetDataQ1_202207 = []; //2022年7月のQ1のデータ

            fireAllData.forEach(x => {
                if (x.year === "2022年7月") {
                    transitionGetData_202207.push(x);  //2022年7月を選択した回答者のデータ取り出し
                    const transitionQ1_202207 = x.q1; //2022年7月の中のQ1の値を取得
                    transitionGetDataQ1_202207.push(transitionQ1_202207);
                }
            });
            console.log(transitionGetDataQ1_202207);
            let sumTransitionQ1_202207 = transitionGetDataQ1_202207.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageTransitionQ1_202207 = (sumTransitionQ1_202207 / transitionGetDataQ1_202207.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageTransitionQ1_202207);
            document.getElementById("transitionGetDataQ1_202207").innerHTML = averageTransitionQ1_202207; // 結果画面への表示

            // -----2022年10月-----
            const transitionGetData_202210 = []; //2022年10月のすべてのデータ
            const transitionGetDataQ1_202210 = []; //2022年10月のQ1のデータ

            fireAllData.forEach(x => {
                if (x.year === "2022年10月") {
                    transitionGetData_202210.push(x);  //2022年10月を選択した回答者のデータ取り出し
                    const transitionQ1_202210 = x.q1; //2022年10月の中のQ1の値を取得
                    transitionGetDataQ1_202210.push(transitionQ1_202210);
                }
            });
            console.log(transitionGetDataQ1_202210);
            let sumTransitionQ1_202210 = transitionGetDataQ1_202210.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageTransitionQ1_202210 = (sumTransitionQ1_202210 / transitionGetDataQ1_202210.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageTransitionQ1_202210);
            document.getElementById("transitionGetDataQ1_202210").innerHTML = averageTransitionQ1_202210; // 結果画面への表示





            // -----------------総合満足度-----------------

            // ---すべての回答データの中からQ2のみ取り出す---
            const allDataQ2 = []; //Q2のすべての回答

            fireAllData.forEach(elm => {
                console.log(elm); //elmはfireAllDataの中の配列を取得
                const answerQ2 = elm.q2; //すべての回答の中からQ2の値を取得
                allDataQ2.push(answerQ2);
            });
            console.log(allDataQ2);

            // 平均点を取得
            let sumQ2 = allDataQ2.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageQ2 = (sumQ2 / allDataQ2.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageQ2);

            // 結果画面への表示
            $("#GetDataQ2").html(averageQ2);



            // ---すべての回答データの中からQ3のみ取り出す---
            const allDataQ3 = []; //Q3のすべての回答

            fireAllData.forEach(elm => {
                console.log(elm); //elmはfireAllDataの中の配列を取得
                const answerQ3 = elm.q3; //すべての回答の中からQ3の値を取得
                allDataQ3.push(answerQ3);
            });
            console.log(allDataQ3);

            // 平均点を取得
            let sumQ3 = allDataQ3.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageQ3 = (sumQ3 / allDataQ3.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageQ3);

            // 結果画面への表示
            $("#GetDataQ3").html(averageQ3);



            // ---すべての回答データの中からQ4のみ取り出す---
            const allDataQ4 = []; //Q4のすべての回答

            fireAllData.forEach(elm => {
                console.log(elm); //elmはfireAllDataの中の配列を取得
                const answerQ4 = elm.q4; //すべての回答の中からQ4の値を取得
                allDataQ4.push(answerQ4);
            });
            console.log(allDataQ4);

            // 平均点を取得
            let sumQ4 = allDataQ4.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageQ4 = (sumQ4 / allDataQ4.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageQ4);

            // 結果画面への表示
            $("#GetDataQ4").html(averageQ4);



            // ---すべての回答データの中からQ5のみ取り出す---
            const allDataQ5 = []; //Q5のすべての回答

            fireAllData.forEach(elm => {
                console.log(elm); //elmはfireAllDataの中の配列を取得
                const answerQ5 = elm.q5; //すべての回答の中からQ5の値を取得
                allDataQ5.push(answerQ5);
            });
            console.log(allDataQ5);

            // 平均点を取得
            let sumQ5 = allDataQ5.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageQ5 = (sumQ5 / allDataQ5.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageQ5);

            // 結果画面への表示
            $("#GetDataQ5").html(averageQ5);



            // ---すべての回答データの中からQ6のみ取り出す---
            const allDataQ6 = []; //Q6のすべての回答

            fireAllData.forEach(elm => {
                console.log(elm); //elmはfireAllDataの中の配列を取得
                const answerQ6 = elm.q6; //すべての回答の中からQ6の値を取得
                allDataQ6.push(answerQ6);
            });
            console.log(allDataQ6);

            // 平均点を取得
            let sumQ6 = allDataQ6.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageQ6 = (sumQ6 / allDataQ6.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageQ6);

            // 結果画面への表示
            $("#GetDataQ6").html(averageQ6);



            // ---すべての回答データの中からQ7のみ取り出す---
            const allDataQ7 = []; //Q7のすべての回答

            fireAllData.forEach(elm => {
                console.log(elm); //elmはfireAllDataの中の配列を取得
                const answerQ7 = elm.q7; //すべての回答の中からQ7の値を取得
                allDataQ7.push(answerQ7);
            });
            console.log(allDataQ7);

            // 平均点を取得
            let sumQ7 = allDataQ7.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageQ7 = (sumQ7 / allDataQ7.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageQ7);

            // 結果画面への表示
            $("#GetDataQ7").html(averageQ7);



            // -----------------属性ごとの満足度-----------------

            // -----性別_女性-----

            const femaleData = [];

            // Q2_労働時間
            const femaleDataQ2Arr = []; //femaleDataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "女性") {
                    femaleData.push(x);  //"女性"を選択した回答者のデータ取り出し
                    const femaleAnswerQ2 = x.q2; //femaleDataの中のQ2の値を取得
                    femaleDataQ2Arr.push(femaleAnswerQ2);
                }
            });
            console.log(femaleDataQ2Arr);
            let sumFemaleQ2 = femaleDataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageFemaleQ2 = (sumFemaleQ2 / femaleDataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageFemaleQ2);
            document.getElementById("genderFemaleDataQ2").innerHTML = averageFemaleQ2; // 結果画面への表示


            // Q3_報酬
            const femaleDataQ3Arr = []; //femaleDataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "女性") {
                    femaleData.push(x);  //"女性"を選択した回答者のデータ取り出し
                    const femaleAnswerQ3 = x.q3; //femaleDataの中のQ3の値を取得
                    femaleDataQ3Arr.push(femaleAnswerQ3);
                }
            });
            console.log(femaleDataQ3Arr);
            let sumFemaleQ3 = femaleDataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageFemaleQ3 = (sumFemaleQ3 / femaleDataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageFemaleQ3);
            document.getElementById("genderFemaleDataQ3").innerHTML = averageFemaleQ3; // 結果画面への表示


            // Q4_仕事のやりがい
            const femaleDataQ4Arr = []; //femaleDataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "女性") {
                    femaleData.push(x);  //"女性"を選択した回答者のデータ取り出し
                    const femaleAnswerQ4 = x.q4; //femaleDataの中のQ4の値を取得
                    femaleDataQ4Arr.push(femaleAnswerQ4);
                }
            });
            console.log(femaleDataQ4Arr);
            let sumFemaleQ4 = femaleDataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageFemaleQ4 = (sumFemaleQ4 / femaleDataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageFemaleQ4);
            document.getElementById("genderFemaleDataQ4").innerHTML = averageFemaleQ4; // 結果画面への表示


            // Q5_自己成長
            const femaleDataQ5Arr = []; //femaleDataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "女性") {
                    femaleData.push(x);  //"女性"を選択した回答者のデータ取り出し
                    const femaleAnswerQ5 = x.q5; //femaleDataの中のQ5の値を取得
                    femaleDataQ5Arr.push(femaleAnswerQ5);
                }
            });
            console.log(femaleDataQ5Arr);
            let sumFemaleQ5 = femaleDataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageFemaleQ5 = (sumFemaleQ5 / femaleDataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageFemaleQ5);
            document.getElementById("genderFemaleDataQ5").innerHTML = averageFemaleQ5; // 結果画面への表示


            // Q6_人間関係
            const femaleDataQ6Arr = []; //femaleDataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "女性") {
                    femaleData.push(x);  //"女性"を選択した回答者のデータ取り出し
                    const femaleAnswerQ6 = x.q6; //femaleDataの中のQ5の値を取得
                    femaleDataQ6Arr.push(femaleAnswerQ6);
                }
            });
            console.log(femaleDataQ6Arr);
            let sumFemaleQ6 = femaleDataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageFemaleQ6 = (sumFemaleQ6 / femaleDataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageFemaleQ6);
            document.getElementById("genderFemaleDataQ6").innerHTML = averageFemaleQ6; // 結果画面への表示


            // Q7_理念への共感
            const femaleDataQ7Arr = []; //femaleDataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "女性") {
                    femaleData.push(x);  //"女性"を選択した回答者のデータ取り出し
                    const femaleAnswerQ7 = x.q7; //femaleDataの中のQ5の値を取得
                    femaleDataQ7Arr.push(femaleAnswerQ7);
                }
            });
            console.log(femaleDataQ7Arr);
            let sumFemaleQ7 = femaleDataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageFemaleQ7 = (sumFemaleQ7 / femaleDataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageFemaleQ7);
            document.getElementById("genderFemaleDataQ7").innerHTML = averageFemaleQ7; // 結果画面への表示





            // -----性別_男性-----

            const maleData = [];

            // Q2_労働時間
            const maleDataQ2Arr = []; //maleDataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "男性") {
                    maleData.push(x);  //"男性"を選択した回答者のデータ取り出し
                    const maleAnswerQ2 = x.q2; //maleDataの中のQ2の値を取得
                    maleDataQ2Arr.push(maleAnswerQ2);
                }
            });
            console.log(maleDataQ2Arr);
            let sumMaleQ2 = maleDataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageMaleQ2 = (sumMaleQ2 / maleDataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageMaleQ2);
            document.getElementById("genderMaleDataQ2").innerHTML = averageMaleQ2; // 結果画面への表示


            // Q3_報酬
            const maleDataQ3Arr = []; //maleDataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "男性") {
                    maleData.push(x);  //"男性"を選択した回答者のデータ取り出し
                    const maleAnswerQ3 = x.q3; //maleDataの中のQ3の値を取得
                    maleDataQ3Arr.push(maleAnswerQ3);
                }
            });
            console.log(maleDataQ3Arr);
            let sumMaleQ3 = maleDataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageMaleQ3 = (sumMaleQ3 / maleDataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageMaleQ3);
            document.getElementById("genderMaleDataQ3").innerHTML = averageMaleQ3; // 結果画面への表示


            // Q4_仕事のやりがい
            const maleDataQ4Arr = []; //maleDataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "男性") {
                    maleData.push(x);  //"男性"を選択した回答者のデータ取り出し
                    const maleAnswerQ4 = x.q4; //maleDataの中のQ4の値を取得
                    maleDataQ4Arr.push(maleAnswerQ4);
                }
            });
            console.log(maleDataQ4Arr);
            let sumMaleQ4 = maleDataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageMaleQ4 = (sumMaleQ4 / maleDataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageMaleQ4);
            document.getElementById("genderMaleDataQ4").innerHTML = averageMaleQ4; // 結果画面への表示


            // Q5_自己成長
            const maleDataQ5Arr = []; //maleDataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "男性") {
                    maleData.push(x);  //"男性"を選択した回答者のデータ取り出し
                    const maleAnswerQ5 = x.q5; //maleDataの中のQ5の値を取得
                    maleDataQ5Arr.push(maleAnswerQ5);
                }
            });
            console.log(maleDataQ5Arr);
            let sumMaleQ5 = maleDataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageMaleQ5 = (sumMaleQ5 / maleDataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageMaleQ5);
            document.getElementById("genderMaleDataQ5").innerHTML = averageMaleQ5; // 結果画面への表示


            // Q6_人間関係
            const maleDataQ6Arr = []; //maleDataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "男性") {
                    maleData.push(x);  //"男性"を選択した回答者のデータ取り出し
                    const maleAnswerQ6 = x.q6; //maleDataの中のQ6の値を取得
                    maleDataQ6Arr.push(maleAnswerQ6);
                }
            });
            console.log(maleDataQ6Arr);
            let sumMaleQ6 = maleDataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageMaleQ6 = (sumMaleQ6 / maleDataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageMaleQ6);
            document.getElementById("genderMaleDataQ6").innerHTML = averageMaleQ6; // 結果画面への表示


            // Q7_理念への共感
            const maleDataQ7Arr = []; //maleDataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.gender === "男性") {
                    maleData.push(x);  //"男性"を選択した回答者のデータ取り出し
                    const maleAnswerQ7 = x.q7; //maleDataの中のQ7の値を取得
                    maleDataQ7Arr.push(maleAnswerQ7);
                }
            });
            console.log(maleDataQ7Arr);
            let sumMaleQ7 = maleDataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageMaleQ7 = (sumMaleQ7 / maleDataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageMaleQ7);
            document.getElementById("genderMaleDataQ7").innerHTML = averageMaleQ7; // 結果画面への表示





            // -----年齢_20代-----

            const age20Data = [];

            // Q2_労働時間
            const age20DataQ2Arr = []; //age20DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "20代") {
                    age20Data.push(x);  //"20代"を選択した回答者のデータ取り出し
                    const age20AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    age20DataQ2Arr.push(age20AnswerQ2);
                }
            });
            console.log(age20DataQ2Arr);
            let sumAge20Q2 = age20DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge20Q2 = (sumAge20Q2 / age20DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge20Q2);
            document.getElementById("age20DataQ2").innerHTML = averageAge20Q2; // 結果画面への表示


            // Q3_報酬
            const age20DataQ3Arr = []; //age20DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "20代") {
                    age20Data.push(x);  //"20代"を選択した回答者のデータ取り出し
                    const age20AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    age20DataQ3Arr.push(age20AnswerQ3);
                }
            });
            console.log(age20DataQ3Arr);
            let sumAge20Q3 = age20DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge20Q3 = (sumAge20Q3 / age20DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge20Q3);
            document.getElementById("age20DataQ3").innerHTML = averageAge20Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const age20DataQ4Arr = []; //age20DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "20代") {
                    age20Data.push(x);  //"20代"を選択した回答者のデータ取り出し
                    const age20AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    age20DataQ4Arr.push(age20AnswerQ4);
                }
            });
            console.log(age20DataQ4Arr);
            let sumAge20Q4 = age20DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge20Q4 = (sumAge20Q4 / age20DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge20Q4);
            document.getElementById("age20DataQ4").innerHTML = averageAge20Q4; // 結果画面への表示



            // Q5_自己成長
            const age20DataQ5Arr = []; //age20DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "20代") {
                    age20Data.push(x);  //"20代"を選択した回答者のデータ取り出し
                    const age20AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    age20DataQ5Arr.push(age20AnswerQ5);
                }
            });
            console.log(age20DataQ5Arr);
            let sumAge20Q5 = age20DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge20Q5 = (sumAge20Q5 / age20DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge20Q5);
            document.getElementById("age20DataQ5").innerHTML = averageAge20Q5; // 結果画面への表示


            // Q6_人間関係
            const age20DataQ6Arr = []; //age20DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "20代") {
                    age20Data.push(x);  //"20代"を選択した回答者のデータ取り出し
                    const age20AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    age20DataQ6Arr.push(age20AnswerQ6);
                }
            });
            console.log(age20DataQ6Arr);
            let sumAge20Q6 = age20DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge20Q6 = (sumAge20Q6 / age20DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge20Q6);
            document.getElementById("age20DataQ6").innerHTML = averageAge20Q6; // 結果画面への表示


            // Q7_理念への共感
            const age20DataQ7Arr = []; //age20DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "20代") {
                    age20Data.push(x);  //"20代"を選択した回答者のデータ取り出し
                    const age20AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    age20DataQ7Arr.push(age20AnswerQ7);
                }
            });
            console.log(age20DataQ7Arr);
            let sumAge20Q7 = age20DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge20Q7 = (sumAge20Q7 / age20DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge20Q7);
            document.getElementById("age20DataQ7").innerHTML = averageAge20Q7; // 結果画面への表示





            // -----年齢_30代-----

            const age30Data = [];

            // Q2_労働時間
            const age30DataQ2Arr = []; //age30DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "30代") {
                    age30Data.push(x);  //"30代"を選択した回答者のデータ取り出し
                    const age30AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    age30DataQ2Arr.push(age30AnswerQ2);
                }
            });
            console.log(age30DataQ2Arr);
            let sumAge30Q2 = age30DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge30Q2 = (sumAge30Q2 / age30DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge30Q2);
            document.getElementById("age30DataQ2").innerHTML = averageAge30Q2; // 結果画面への表示


            // Q3_報酬
            const age30DataQ3Arr = []; //age30DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "30代") {
                    age30Data.push(x);  //"30代"を選択した回答者のデータ取り出し
                    const age30AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    age30DataQ3Arr.push(age30AnswerQ3);
                }
            });
            console.log(age30DataQ3Arr);
            let sumAge30Q3 = age30DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge30Q3 = (sumAge30Q3 / age30DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge30Q3);
            document.getElementById("age30DataQ3").innerHTML = averageAge30Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const age30DataQ4Arr = []; //age30DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "30代") {
                    age30Data.push(x);  //"30代"を選択した回答者のデータ取り出し
                    const age30AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    age30DataQ4Arr.push(age30AnswerQ4);
                }
            });
            console.log(age30DataQ4Arr);
            let sumAge30Q4 = age30DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge30Q4 = (sumAge30Q4 / age30DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge30Q4);
            document.getElementById("age30DataQ4").innerHTML = averageAge30Q4; // 結果画面への表示


            // Q5_自己成長
            const age30DataQ5Arr = []; //age30DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "30代") {
                    age30Data.push(x);  //"30代"を選択した回答者のデータ取り出し
                    const age30AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    age30DataQ5Arr.push(age30AnswerQ5);
                }
            });
            console.log(age30DataQ5Arr);
            let sumAge30Q5 = age30DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge30Q5 = (sumAge30Q5 / age30DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge30Q5);
            document.getElementById("age30DataQ5").innerHTML = averageAge30Q5; // 結果画面への表示


            // Q6_人間関係
            const age30DataQ6Arr = []; //age30DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "30代") {
                    age30Data.push(x);  //"30代"を選択した回答者のデータ取り出し
                    const age30AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    age30DataQ6Arr.push(age30AnswerQ6);
                }
            });
            console.log(age30DataQ6Arr);
            let sumAge30Q6 = age30DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge30Q6 = (sumAge30Q6 / age30DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge30Q6);
            document.getElementById("age30DataQ6").innerHTML = averageAge30Q6; // 結果画面への表示


            // Q7_理念への共感
            const age30DataQ7Arr = []; //age30DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "30代") {
                    age30Data.push(x);  //"30代"を選択した回答者のデータ取り出し
                    const age30AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    age30DataQ7Arr.push(age30AnswerQ7);
                }
            });
            console.log(age30DataQ7Arr);
            let sumAge30Q7 = age30DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge30Q7 = (sumAge30Q7 / age30DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge30Q7);
            document.getElementById("age30DataQ7").innerHTML = averageAge30Q7; // 結果画面への表示





            // -----年齢_40代-----

            const age40Data = [];

            // Q2_労働時間
            const age40DataQ2Arr = []; //age40DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "40代") {
                    age40Data.push(x);  //"40代"を選択した回答者のデータ取り出し
                    const age40AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    age40DataQ2Arr.push(age40AnswerQ2);
                }
            });
            console.log(age40DataQ2Arr);
            let sumAge40Q2 = age40DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge40Q2 = (sumAge40Q2 / age40DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge40Q2);
            document.getElementById("age40DataQ2").innerHTML = averageAge40Q2; // 結果画面への表示


            // Q3_報酬
            const age40DataQ3Arr = []; //age40DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "40代") {
                    age40Data.push(x);  //"40代"を選択した回答者のデータ取り出し
                    const age40AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    age40DataQ3Arr.push(age40AnswerQ3);
                }
            });
            console.log(age40DataQ3Arr);
            let sumAge40Q3 = age40DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge40Q3 = (sumAge40Q3 / age40DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge40Q3);
            document.getElementById("age40DataQ3").innerHTML = averageAge40Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const age40DataQ4Arr = []; //age40DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "40代") {
                    age40Data.push(x);  //"40代"を選択した回答者のデータ取り出し
                    const age40AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    age40DataQ4Arr.push(age40AnswerQ4);
                }
            });
            console.log(age40DataQ4Arr);
            let sumAge40Q4 = age40DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge40Q4 = (sumAge40Q4 / age40DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge40Q4);
            document.getElementById("age40DataQ4").innerHTML = averageAge40Q4; // 結果画面への表示


            // Q5_自己成長
            const age40DataQ5Arr = []; //age40DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "40代") {
                    age40Data.push(x);  //"40代"を選択した回答者のデータ取り出し
                    const age40AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    age40DataQ5Arr.push(age40AnswerQ5);
                }
            });
            console.log(age40DataQ5Arr);
            let sumAge40Q5 = age40DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge40Q5 = (sumAge40Q5 / age40DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge40Q5);
            document.getElementById("age40DataQ5").innerHTML = averageAge40Q5; // 結果画面への表示


            // Q6_人間関係
            const age40DataQ6Arr = []; //age40DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "40代") {
                    age40Data.push(x);  //"40代"を選択した回答者のデータ取り出し
                    const age40AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    age40DataQ6Arr.push(age40AnswerQ6);
                }
            });
            console.log(age40DataQ6Arr);
            let sumAge40Q6 = age40DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge40Q6 = (sumAge40Q6 / age40DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge40Q6);
            document.getElementById("age40DataQ6").innerHTML = averageAge40Q6; // 結果画面への表示


            // Q7_理念への共感
            const age40DataQ7Arr = []; //age40DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "40代") {
                    age40Data.push(x);  //"40代"を選択した回答者のデータ取り出し
                    const age40AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    age40DataQ7Arr.push(age40AnswerQ7);
                }
            });
            console.log(age40DataQ7Arr);
            let sumAge40Q7 = age40DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge40Q7 = (sumAge40Q7 / age40DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge40Q7);
            document.getElementById("age40DataQ7").innerHTML = averageAge40Q7; // 結果画面への表示





            // -----年齢_50代-----

            const age50Data = [];

            // Q2_労働時間
            const age50DataQ2Arr = []; //age50DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "50代") {
                    age50Data.push(x);  //"50代"を選択した回答者のデータ取り出し
                    const age50AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    age50DataQ2Arr.push(age50AnswerQ2);
                }
            });
            console.log(age50DataQ2Arr);
            let sumAge50Q2 = age50DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge50Q2 = (sumAge50Q2 / age50DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge50Q2);
            document.getElementById("age50DataQ2").innerHTML = averageAge50Q2; // 結果画面への表示


            // Q3_報酬
            const age50DataQ3Arr = []; //age50DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "50代") {
                    age50Data.push(x);  //"50代"を選択した回答者のデータ取り出し
                    const age50AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    age50DataQ3Arr.push(age50AnswerQ3);
                }
            });
            console.log(age50DataQ3Arr);
            let sumAge50Q3 = age50DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge50Q3 = (sumAge50Q3 / age50DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge50Q3);
            document.getElementById("age50DataQ3").innerHTML = averageAge50Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const age50DataQ4Arr = []; //age50DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "50代") {
                    age50Data.push(x);  //"50代"を選択した回答者のデータ取り出し
                    const age50AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    age50DataQ4Arr.push(age50AnswerQ4);
                }
            });
            console.log(age50DataQ4Arr);
            let sumAge50Q4 = age50DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge50Q4 = (sumAge50Q4 / age50DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge50Q4);
            document.getElementById("age50DataQ4").innerHTML = averageAge50Q4; // 結果画面への表示


            // Q5_自己成長
            const age50DataQ5Arr = []; //age50DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "50代") {
                    age50Data.push(x);  //"50代"を選択した回答者のデータ取り出し
                    const age50AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    age50DataQ5Arr.push(age50AnswerQ5);
                }
            });
            console.log(age50DataQ5Arr);
            let sumAge50Q5 = age50DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge50Q5 = (sumAge50Q5 / age50DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge50Q5);
            document.getElementById("age50DataQ5").innerHTML = averageAge50Q5; // 結果画面への表示


            // Q6_人間関係
            const age50DataQ6Arr = []; //age50DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "50代") {
                    age50Data.push(x);  //"50代"を選択した回答者のデータ取り出し
                    const age50AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    age50DataQ6Arr.push(age50AnswerQ6);
                }
            });
            console.log(age50DataQ6Arr);
            let sumAge50Q6 = age50DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge50Q6 = (sumAge50Q6 / age50DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge50Q6);
            document.getElementById("age50DataQ6").innerHTML = averageAge50Q6; // 結果画面への表示


            // Q7_理念への共感
            const age50DataQ7Arr = []; //age50DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.age === "50代") {
                    age50Data.push(x);  //"50代"を選択した回答者のデータ取り出し
                    const age50AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    age50DataQ7Arr.push(age50AnswerQ7);
                }
            });
            console.log(age50DataQ7Arr);
            let sumAge50Q7 = age50DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAge50Q7 = (sumAge50Q7 / age50DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAge50Q7);
            document.getElementById("age50DataQ7").innerHTML = averageAge50Q7; // 結果画面への表示



            // -----所属_的場店-----

            const affiliationMatobaData = [];

            // Q2_労働時間
            const affiliationMatobaDataQ2Arr = []; //affiliationMatobaDataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "的場店") {
                    affiliationMatobaData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationMatobaAnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    affiliationMatobaDataQ2Arr.push(affiliationMatobaAnswerQ2);
                }
            });
            console.log(affiliationMatobaDataQ2Arr);
            let sumAffiliationMatobaQ2 = affiliationMatobaDataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationMatobaQ2 = (sumAffiliationMatobaQ2 / affiliationMatobaDataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationMatobaQ2);
            document.getElementById("affiliationMatobaDataQ2").innerHTML = averageAffiliationMatobaQ2; // 結果画面への表示


            // Q3_報酬
            const affiliationMatobaDataQ3Arr = []; //affiliationMatobaDataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "的場店") {
                    affiliationMatobaData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationMatobaAnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    affiliationMatobaDataQ3Arr.push(affiliationMatobaAnswerQ3);
                }
            });
            console.log(affiliationMatobaDataQ3Arr);
            let sumAffiliationMatobaQ3 = affiliationMatobaDataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationMatobaQ3 = (sumAffiliationMatobaQ3 / affiliationMatobaDataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationMatobaQ3);
            document.getElementById("affiliationMatobaDataQ3").innerHTML = averageAffiliationMatobaQ3; // 結果画面への表示


            // Q4_仕事のやりがい
            const affiliationMatobaDataQ4Arr = []; //affiliationMatobaDataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "的場店") {
                    affiliationMatobaData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationMatobaAnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    affiliationMatobaDataQ4Arr.push(affiliationMatobaAnswerQ4);
                }
            });
            console.log(affiliationMatobaDataQ4Arr);
            let sumAffiliationMatobaQ4 = affiliationMatobaDataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationMatobaQ4 = (sumAffiliationMatobaQ4 / affiliationMatobaDataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationMatobaQ4);
            document.getElementById("affiliationMatobaDataQ4").innerHTML = averageAffiliationMatobaQ4; // 結果画面への表示


            // Q5_自己成長
            const affiliationMatobaDataQ5Arr = []; //affiliationMatobaDataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "的場店") {
                    affiliationMatobaData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationMatobaAnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    affiliationMatobaDataQ5Arr.push(affiliationMatobaAnswerQ5);
                }
            });
            console.log(affiliationMatobaDataQ5Arr);
            let sumAffiliationMatobaQ5 = affiliationMatobaDataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationMatobaQ5 = (sumAffiliationMatobaQ5 / affiliationMatobaDataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationMatobaQ5);
            document.getElementById("affiliationMatobaDataQ5").innerHTML = averageAffiliationMatobaQ5; // 結果画面への表示


            // Q6_人間関係
            const affiliationMatobaDataQ6Arr = []; //affiliationMatobaDataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "的場店") {
                    affiliationMatobaData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationMatobaAnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    affiliationMatobaDataQ6Arr.push(affiliationMatobaAnswerQ6);
                }
            });
            console.log(affiliationMatobaDataQ6Arr);
            let sumAffiliationMatobaQ6 = affiliationMatobaDataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationMatobaQ6 = (sumAffiliationMatobaQ6 / affiliationMatobaDataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationMatobaQ6);
            document.getElementById("affiliationMatobaDataQ6").innerHTML = averageAffiliationMatobaQ6; // 結果画面への表示


            // Q7_理念への共感
            const affiliationMatobaDataQ7Arr = []; //affiliationMatobaDataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "的場店") {
                    affiliationMatobaData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationMatobaAnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    affiliationMatobaDataQ7Arr.push(affiliationMatobaAnswerQ7);
                }
            });
            console.log(affiliationMatobaDataQ7Arr);
            let sumAffiliationMatobaQ7 = affiliationMatobaDataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationMatobaQ7 = (sumAffiliationMatobaQ7 / affiliationMatobaDataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationMatobaQ7);
            document.getElementById("affiliationMatobaDataQ7").innerHTML = averageAffiliationMatobaQ7; // 結果画面への表示



            // -----所属_次郎丸店-----

            const affiliationJiromaruData = [];

            // Q2_労働時間
            const affiliationJiromaruDataQ2Arr = []; //affiliationJiromaruDataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "次郎丸店") {
                    affiliationJiromaruData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationJiromaruAnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    affiliationJiromaruDataQ2Arr.push(affiliationJiromaruAnswerQ2);
                }
            });
            console.log(affiliationJiromaruDataQ2Arr);
            let sumAffiliationJiromaruQ2 = affiliationJiromaruDataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationJiromaruQ2 = (sumAffiliationJiromaruQ2 / affiliationJiromaruDataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationJiromaruQ2);
            document.getElementById("affiliationJiromaruDataQ2").innerHTML = averageAffiliationJiromaruQ2; // 結果画面への表示


            // Q3_報酬
            const affiliationJiromaruDataQ3Arr = []; //affiliationJiromaruDataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "次郎丸店") {
                    affiliationJiromaruData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationJiromaruAnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    affiliationJiromaruDataQ3Arr.push(affiliationJiromaruAnswerQ3);
                }
            });
            console.log(affiliationJiromaruDataQ3Arr);
            let sumAffiliationJiromaruQ3 = affiliationJiromaruDataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationJiromaruQ3 = (sumAffiliationJiromaruQ3 / affiliationJiromaruDataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationJiromaruQ3);
            document.getElementById("affiliationJiromaruDataQ3").innerHTML = averageAffiliationJiromaruQ3; // 結果画面への表示


            // Q4_仕事のやりがい
            const affiliationJiromaruDataQ4Arr = []; //affiliationJiromaruDataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "次郎丸店") {
                    affiliationJiromaruData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationJiromaruAnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    affiliationJiromaruDataQ4Arr.push(affiliationJiromaruAnswerQ4);
                }
            });
            console.log(affiliationJiromaruDataQ4Arr);
            let sumAffiliationJiromaruQ4 = affiliationJiromaruDataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationJiromaruQ4 = (sumAffiliationJiromaruQ4 / affiliationJiromaruDataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationJiromaruQ4);
            document.getElementById("affiliationJiromaruDataQ4").innerHTML = averageAffiliationJiromaruQ4; // 結果画面への表示


            // Q5_自己成長
            const affiliationJiromaruDataQ5Arr = []; //affiliationJiromaruDataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "次郎丸店") {
                    affiliationJiromaruData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationJiromaruAnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    affiliationJiromaruDataQ5Arr.push(affiliationJiromaruAnswerQ5);
                }
            });
            console.log(affiliationJiromaruDataQ5Arr);
            let sumAffiliationJiromaruQ5 = affiliationJiromaruDataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationJiromaruQ5 = (sumAffiliationJiromaruQ5 / affiliationJiromaruDataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationJiromaruQ5);
            document.getElementById("affiliationJiromaruDataQ5").innerHTML = averageAffiliationJiromaruQ5; // 結果画面への表示


            // Q6_人間関係
            const affiliationJiromaruDataQ6Arr = []; //affiliationJiromaruDataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "次郎丸店") {
                    affiliationJiromaruData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationJiromaruAnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    affiliationJiromaruDataQ6Arr.push(affiliationJiromaruAnswerQ6);
                }
            });
            console.log(affiliationJiromaruDataQ6Arr);
            let sumAffiliationJiromaruQ6 = affiliationJiromaruDataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationJiromaruQ6 = (sumAffiliationJiromaruQ6 / affiliationJiromaruDataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationJiromaruQ6);
            document.getElementById("affiliationJiromaruDataQ6").innerHTML = averageAffiliationJiromaruQ6; // 結果画面への表示


            // Q7_理念への共感
            const affiliationJiromaruDataQ7Arr = []; //affiliationJiromaruDataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.affiliation === "次郎丸店") {
                    affiliationJiromaruData.push(x);  //"的場店"を選択した回答者のデータ取り出し
                    const affiliationJiromaruAnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    affiliationJiromaruDataQ7Arr.push(affiliationJiromaruAnswerQ7);
                }
            });
            console.log(affiliationJiromaruDataQ7Arr);
            let sumAffiliationJiromaruQ7 = affiliationJiromaruDataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageAffiliationJiromaruQ7 = (sumAffiliationJiromaruQ7 / affiliationJiromaruDataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageAffiliationJiromaruQ7);
            document.getElementById("affiliationJiromaruDataQ7").innerHTML = averageAffiliationJiromaruQ7; // 結果画面への表示



            // -----職種_看護師-----

            const occupationNurseData = [];

            // Q2_労働時間
            const occupationNurseDataQ2Arr = []; //occupationNurseDataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "看護師") {
                    occupationNurseData.push(x);  //"看護師"を選択した回答者のデータ取り出し
                    const occupationNurseAnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    occupationNurseDataQ2Arr.push(occupationNurseAnswerQ2);
                }
            });
            console.log(occupationNurseDataQ2Arr);
            let sumOccupationNurseQ2 = occupationNurseDataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationNurseQ2 = (sumOccupationNurseQ2 / occupationNurseDataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationNurseQ2);
            document.getElementById("occupationNurseDataQ2").innerHTML = averageOccupationNurseQ2; // 結果画面への表示


            // Q3_報酬
            const occupationNurseDataQ3Arr = []; //occupationNurseDataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "看護師") {
                    occupationNurseData.push(x);  //"看護師"を選択した回答者のデータ取り出し
                    const occupationNurseAnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    occupationNurseDataQ3Arr.push(occupationNurseAnswerQ3);
                }
            });
            console.log(occupationNurseDataQ3Arr);
            let sumOccupationNurseQ3 = occupationNurseDataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationNurseQ3 = (sumOccupationNurseQ3 / occupationNurseDataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationNurseQ3);
            document.getElementById("occupationNurseDataQ3").innerHTML = averageOccupationNurseQ3; // 結果画面への表示


            // Q4_仕事のやりがい
            const occupationNurseDataQ4Arr = []; //occupationNurseDataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "看護師") {
                    occupationNurseData.push(x);  //"看護師"を選択した回答者のデータ取り出し
                    const occupationNurseAnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    occupationNurseDataQ4Arr.push(occupationNurseAnswerQ4);
                }
            });
            console.log(occupationNurseDataQ4Arr);
            let sumOccupationNurseQ4 = occupationNurseDataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationNurseQ4 = (sumOccupationNurseQ4 / occupationNurseDataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationNurseQ4);
            document.getElementById("occupationNurseDataQ4").innerHTML = averageOccupationNurseQ4; // 結果画面への表示


            // Q5_自己成長
            const occupationNurseDataQ5Arr = []; //occupationNurseDataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "看護師") {
                    occupationNurseData.push(x);  //"看護師"を選択した回答者のデータ取り出し
                    const occupationNurseAnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    occupationNurseDataQ5Arr.push(occupationNurseAnswerQ5);
                }
            });
            console.log(occupationNurseDataQ5Arr);
            let sumOccupationNurseQ5 = occupationNurseDataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationNurseQ5 = (sumOccupationNurseQ5 / occupationNurseDataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationNurseQ5);
            document.getElementById("occupationNurseDataQ5").innerHTML = averageOccupationNurseQ5; // 結果画面への表示


            // Q6_人間関係
            const occupationNurseDataQ6Arr = []; //occupationNurseDataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "看護師") {
                    occupationNurseData.push(x);  //"看護師"を選択した回答者のデータ取り出し
                    const occupationNurseAnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    occupationNurseDataQ6Arr.push(occupationNurseAnswerQ6);
                }
            });
            console.log(occupationNurseDataQ6Arr);
            let sumOccupationNurseQ6 = occupationNurseDataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationNurseQ6 = (sumOccupationNurseQ6 / occupationNurseDataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationNurseQ6);
            document.getElementById("occupationNurseDataQ6").innerHTML = averageOccupationNurseQ6; // 結果画面への表示


            // Q7_理念への共感
            const occupationNurseDataQ7Arr = []; //occupationNurseDataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "看護師") {
                    occupationNurseData.push(x);  //"看護師"を選択した回答者のデータ取り出し
                    const occupationNurseAnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    occupationNurseDataQ7Arr.push(occupationNurseAnswerQ7);
                }
            });
            console.log(occupationNurseDataQ7Arr);
            let sumOccupationNurseQ7 = occupationNurseDataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationNurseQ7 = (sumOccupationNurseQ7 / occupationNurseDataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationNurseQ7);
            document.getElementById("occupationNurseDataQ7").innerHTML = averageOccupationNurseQ7; // 結果画面への表示



            // -----職種_セラピスト-----

            const occupationTherapistData = [];

            // Q2_労働時間
            const occupationTherapistDataQ2Arr = []; //occupationTherapistDataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "セラピスト") {
                    occupationTherapistData.push(x);  //"セラピスト"を選択した回答者のデータ取り出し
                    const occupationTherapistAnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    occupationTherapistDataQ2Arr.push(occupationTherapistAnswerQ2);
                }
            });
            console.log(occupationTherapistDataQ2Arr);
            let sumOccupationTherapistQ2 = occupationTherapistDataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationTherapistQ2 = (sumOccupationTherapistQ2 / occupationTherapistDataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationTherapistQ2);
            document.getElementById("occupationTherapistDataQ2").innerHTML = averageOccupationTherapistQ2; // 結果画面への表示


            // Q3_報酬
            const occupationTherapistDataQ3Arr = []; //occupationTherapistDataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "セラピスト") {
                    occupationTherapistData.push(x);  //"セラピスト"を選択した回答者のデータ取り出し
                    const occupationTherapistAnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    occupationTherapistDataQ3Arr.push(occupationTherapistAnswerQ3);
                }
            });
            console.log(occupationTherapistDataQ3Arr);
            let sumOccupationTherapistQ3 = occupationTherapistDataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationTherapistQ3 = (sumOccupationTherapistQ3 / occupationTherapistDataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationTherapistQ3);
            document.getElementById("occupationTherapistDataQ3").innerHTML = averageOccupationTherapistQ3; // 結果画面への表示


            // Q4_仕事のやりがい
            const occupationTherapistDataQ4Arr = []; //occupationTherapistDataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "セラピスト") {
                    occupationTherapistData.push(x);  //"セラピスト"を選択した回答者のデータ取り出し
                    const occupationTherapistAnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    occupationTherapistDataQ4Arr.push(occupationTherapistAnswerQ4);
                }
            });
            console.log(occupationTherapistDataQ4Arr);
            let sumOccupationTherapistQ4 = occupationTherapistDataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationTherapistQ4 = (sumOccupationTherapistQ4 / occupationTherapistDataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationTherapistQ4);
            document.getElementById("occupationTherapistDataQ4").innerHTML = averageOccupationTherapistQ4; // 結果画面への表示


            // Q5_自己成長
            const occupationTherapistDataQ5Arr = []; //occupationTherapistDataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "セラピスト") {
                    occupationTherapistData.push(x);  //"セラピスト"を選択した回答者のデータ取り出し
                    const occupationTherapistAnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    occupationTherapistDataQ5Arr.push(occupationTherapistAnswerQ5);
                }
            });
            console.log(occupationTherapistDataQ5Arr);
            let sumOccupationTherapistQ5 = occupationTherapistDataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationTherapistQ5 = (sumOccupationTherapistQ5 / occupationTherapistDataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationTherapistQ5);
            document.getElementById("occupationTherapistDataQ5").innerHTML = averageOccupationTherapistQ5; // 結果画面への表示


            // Q6_人間関係
            const occupationTherapistDataQ6Arr = []; //occupationTherapistDataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "セラピスト") {
                    occupationTherapistData.push(x);  //"セラピスト"を選択した回答者のデータ取り出し
                    const occupationTherapistAnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    occupationTherapistDataQ6Arr.push(occupationTherapistAnswerQ6);
                }
            });
            console.log(occupationTherapistDataQ6Arr);
            let sumOccupationTherapistQ6 = occupationTherapistDataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationTherapistQ6 = (sumOccupationTherapistQ6 / occupationTherapistDataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationTherapistQ6);
            document.getElementById("occupationTherapistDataQ6").innerHTML = averageOccupationTherapistQ6; // 結果画面への表示


            // Q7_理念への共感
            const occupationTherapistDataQ7Arr = []; //occupationTherapistDataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "セラピスト") {
                    occupationTherapistData.push(x);  //"セラピスト"を選択した回答者のデータ取り出し
                    const occupationTherapistAnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    occupationTherapistDataQ7Arr.push(occupationTherapistAnswerQ7);
                }
            });
            console.log(occupationTherapistDataQ7Arr);
            let sumOccupationTherapistQ7 = occupationTherapistDataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationTherapistQ7 = (sumOccupationTherapistQ7 / occupationTherapistDataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationTherapistQ7);
            document.getElementById("occupationTherapistDataQ7").innerHTML = averageOccupationTherapistQ7; // 結果画面への表示



            // -----職種_事務-----

            const occupationClerkData = [];

            // Q2_労働時間
            const occupationClerkDataQ2Arr = []; //occupationClerkDataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "事務") {
                    occupationClerkData.push(x);  //"事務"を選択した回答者のデータ取り出し
                    const occupationClerkAnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    occupationClerkDataQ2Arr.push(occupationClerkAnswerQ2);
                }
            });
            console.log(occupationClerkDataQ2Arr);
            let sumOccupationClerkQ2 = occupationClerkDataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationClerkQ2 = (sumOccupationClerkQ2 / occupationClerkDataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationClerkQ2);
            document.getElementById("occupationClerkDataQ2").innerHTML = averageOccupationClerkQ2; // 結果画面への表示


            // Q3_報酬
            const occupationClerkDataQ3Arr = []; //occupationClerkDataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "事務") {
                    occupationClerkData.push(x);  //"事務"を選択した回答者のデータ取り出し
                    const occupationClerkAnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    occupationClerkDataQ3Arr.push(occupationClerkAnswerQ3);
                }
            });
            console.log(occupationClerkDataQ3Arr);
            let sumOccupationClerkQ3 = occupationClerkDataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationClerkQ3 = (sumOccupationClerkQ3 / occupationClerkDataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationClerkQ3);
            document.getElementById("occupationClerkDataQ3").innerHTML = averageOccupationClerkQ3; // 結果画面への表示


            // Q4_仕事のやりがい
            const occupationClerkDataQ4Arr = []; //occupationClerkDataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "事務") {
                    occupationClerkData.push(x);  //"事務"を選択した回答者のデータ取り出し
                    const occupationClerkAnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    occupationClerkDataQ4Arr.push(occupationClerkAnswerQ4);
                }
            });
            console.log(occupationClerkDataQ4Arr);
            let sumOccupationClerkQ4 = occupationClerkDataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationClerkQ4 = (sumOccupationClerkQ4 / occupationClerkDataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationClerkQ4);
            document.getElementById("occupationClerkDataQ4").innerHTML = averageOccupationClerkQ4; // 結果画面への表示


            // Q5_自己成長
            const occupationClerkDataQ5Arr = []; //occupationClerkDataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "事務") {
                    occupationClerkData.push(x);  //"事務"を選択した回答者のデータ取り出し
                    const occupationClerkAnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    occupationClerkDataQ5Arr.push(occupationClerkAnswerQ5);
                }
            });
            console.log(occupationClerkDataQ5Arr);
            let sumOccupationClerkQ5 = occupationClerkDataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationClerkQ5 = (sumOccupationClerkQ5 / occupationClerkDataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationClerkQ5);
            document.getElementById("occupationClerkDataQ5").innerHTML = averageOccupationClerkQ5; // 結果画面への表示


            // Q6_人間関係
            const occupationClerkDataQ6Arr = []; //occupationClerkDataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "事務") {
                    occupationClerkData.push(x);  //"事務"を選択した回答者のデータ取り出し
                    const occupationClerkAnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    occupationClerkDataQ6Arr.push(occupationClerkAnswerQ6);
                }
            });
            console.log(occupationClerkDataQ6Arr);
            let sumOccupationClerkQ6 = occupationClerkDataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationClerkQ6 = (sumOccupationClerkQ6 / occupationClerkDataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationClerkQ6);
            document.getElementById("occupationClerkDataQ6").innerHTML = averageOccupationClerkQ6; // 結果画面への表示


            // Q7_理念への共感
            const occupationClerkDataQ7Arr = []; //occupationClerkDataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.occupation === "事務") {
                    occupationClerkData.push(x);  //"事務"を選択した回答者のデータ取り出し
                    const occupationClerkAnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    occupationClerkDataQ7Arr.push(occupationClerkAnswerQ7);
                }
            });
            console.log(occupationClerkDataQ7Arr);
            let sumOccupationClerkQ7 = occupationClerkDataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageOccupationClerkQ7 = (sumOccupationClerkQ7 / occupationClerkDataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageOccupationClerkQ7);
            document.getElementById("occupationClerkDataQ7").innerHTML = averageOccupationClerkQ7; // 結果画面への表示





            // -----勤続年数_半年未満-----

            const length1Data = [];

            // Q2_労働時間
            const length1DataQ2Arr = []; //length1DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1年未満") {
                    length1Data.push(x);  //"1年未満"を選択した回答者のデータ取り出し
                    const length1AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    length1DataQ2Arr.push(length1AnswerQ2);
                }
            });
            console.log(length1DataQ2Arr);
            let sumLength1Q2 = length1DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength1Q2 = (sumLength1Q2 / length1DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength1Q2);
            document.getElementById("length1DataQ2").innerHTML = averageLength1Q2; // 結果画面への表示


            // Q3_報酬
            const length1DataQ3Arr = []; //length1DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1年未満") {
                    length1Data.push(x);  //"1年未満"を選択した回答者のデータ取り出し
                    const length1AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    length1DataQ3Arr.push(length1AnswerQ3);
                }
            });
            console.log(length1DataQ3Arr);
            let sumLength1Q3 = length1DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength1Q3 = (sumLength1Q3 / length1DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength1Q3);
            document.getElementById("length1DataQ3").innerHTML = averageLength1Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const length1DataQ4Arr = []; //length1DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1年未満") {
                    length1Data.push(x);  //"1年未満"を選択した回答者のデータ取り出し
                    const length1AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    length1DataQ4Arr.push(length1AnswerQ4);
                }
            });
            console.log(length1DataQ4Arr);
            let sumLength1Q4 = length1DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength1Q4 = (sumLength1Q4 / length1DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength1Q4);
            document.getElementById("length1DataQ4").innerHTML = averageLength1Q4; // 結果画面への表示


            // Q5_自己成長
            const length1DataQ5Arr = []; //length1DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1年未満") {
                    length1Data.push(x);  //"1年未満"を選択した回答者のデータ取り出し
                    const length1AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    length1DataQ5Arr.push(length1AnswerQ5);
                }
            });
            console.log(length1DataQ5Arr);
            let sumLength1Q5 = length1DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength1Q5 = (sumLength1Q5 / length1DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength1Q5);
            document.getElementById("length1DataQ5").innerHTML = averageLength1Q5; // 結果画面への表示


            // Q6_人間関係
            const length1DataQ6Arr = []; //length1DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1年未満") {
                    length1Data.push(x);  //"1年未満"を選択した回答者のデータ取り出し
                    const length1AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    length1DataQ6Arr.push(length1AnswerQ6);
                }
            });
            console.log(length1DataQ6Arr);
            let sumLength1Q6 = length1DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength1Q6 = (sumLength1Q6 / length1DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength1Q6);
            document.getElementById("length1DataQ6").innerHTML = averageLength1Q6; // 結果画面への表示


            // Q7_理念への共感
            const length1DataQ7Arr = []; //length1DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1年未満") {
                    length1Data.push(x);  //"1年未満"を選択した回答者のデータ取り出し
                    const length1AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    length1DataQ7Arr.push(length1AnswerQ7);
                }
            });
            console.log(length1DataQ7Arr);
            let sumLength1Q7 = length1DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength1Q7 = (sumLength1Q7 / length1DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength1Q7);
            document.getElementById("length1DataQ7").innerHTML = averageLength1Q7; // 結果画面への表示



            // -----勤続年数_1-2年-----

            const length12Data = [];

            // Q2_労働時間
            const length12DataQ2Arr = []; //length12DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1-2年") {
                    length12Data.push(x);  //"1-2年"を選択した回答者のデータ取り出し
                    const length12AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    length12DataQ2Arr.push(length12AnswerQ2);
                }
            });
            console.log(length12DataQ2Arr);
            let sumLength12Q2 = length12DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength12Q2 = (sumLength12Q2 / length12DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength12Q2);
            document.getElementById("length12DataQ2").innerHTML = averageLength12Q2; // 結果画面への表示


            // Q3_報酬
            const length12DataQ3Arr = []; //length12DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1-2年") {
                    length12Data.push(x);  //"1-2年"を選択した回答者のデータ取り出し
                    const length12AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    length12DataQ3Arr.push(length12AnswerQ3);
                }
            });
            console.log(length12DataQ3Arr);
            let sumLength12Q3 = length12DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength12Q3 = (sumLength12Q3 / length12DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength12Q3);
            document.getElementById("length12DataQ3").innerHTML = averageLength12Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const length12DataQ4Arr = []; //length12DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1-2年") {
                    length12Data.push(x);  //"1-2年"を選択した回答者のデータ取り出し
                    const length12AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    length12DataQ4Arr.push(length12AnswerQ4);
                }
            });
            console.log(length12DataQ4Arr);
            let sumLength12Q4 = length12DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength12Q4 = (sumLength12Q4 / length12DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength12Q4);
            document.getElementById("length12DataQ4").innerHTML = averageLength12Q4; // 結果画面への表示


            // Q5_自己成長
            const length12DataQ5Arr = []; //length12DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1-2年") {
                    length12Data.push(x);  //"1-2年"を選択した回答者のデータ取り出し
                    const length12AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    length12DataQ5Arr.push(length12AnswerQ5);
                }
            });
            console.log(length12DataQ5Arr);
            let sumLength12Q5 = length12DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength12Q5 = (sumLength12Q5 / length12DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength12Q5);
            document.getElementById("length12DataQ5").innerHTML = averageLength12Q5; // 結果画面への表示


            // Q6_人間関係
            const length12DataQ6Arr = []; //length12DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1-2年") {
                    length12Data.push(x);  //"1-2年"を選択した回答者のデータ取り出し
                    const length12AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    length12DataQ6Arr.push(length12AnswerQ6);
                }
            });
            console.log(length12DataQ6Arr);
            let sumLength12Q6 = length12DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength12Q6 = (sumLength12Q6 / length12DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength12Q6);
            document.getElementById("length12DataQ6").innerHTML = averageLength12Q6; // 結果画面への表示


            // Q7_理念への共感
            const length12DataQ7Arr = []; //length12DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "1-2年") {
                    length12Data.push(x);  //"1-2年"を選択した回答者のデータ取り出し
                    const length12AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    length12DataQ7Arr.push(length12AnswerQ7);
                }
            });
            console.log(length12DataQ7Arr);
            let sumLength12Q7 = length12DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength12Q7 = (sumLength12Q7 / length12DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength12Q7);
            document.getElementById("length12DataQ7").innerHTML = averageLength12Q7; // 結果画面への表示



            // -----勤続年数_2-3年-----

            const length23Data = [];

            // Q2_労働時間
            const length23DataQ2Arr = []; //length23DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "2-3年") {
                    length23Data.push(x);  //"2-3年"を選択した回答者のデータ取り出し
                    const length23AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    length23DataQ2Arr.push(length23AnswerQ2);
                }
            });
            console.log(length23DataQ2Arr);
            let sumLength23Q2 = length23DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength23Q2 = (sumLength23Q2 / length23DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength23Q2);
            document.getElementById("length23DataQ2").innerHTML = averageLength23Q2; // 結果画面への表示


            // Q3_報酬
            const length23DataQ3Arr = []; //length23DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "2-3年") {
                    length23Data.push(x);  //"2-3年"を選択した回答者のデータ取り出し
                    const length23AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    length23DataQ3Arr.push(length23AnswerQ3);
                }
            });
            console.log(length23DataQ3Arr);
            let sumLength23Q3 = length23DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength23Q3 = (sumLength23Q3 / length23DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength23Q3);
            document.getElementById("length23DataQ3").innerHTML = averageLength23Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const length23DataQ4Arr = []; //length23DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "2-3年") {
                    length23Data.push(x);  //"2-3年"を選択した回答者のデータ取り出し
                    const length23AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    length23DataQ4Arr.push(length23AnswerQ4);
                }
            });
            console.log(length23DataQ4Arr);
            let sumLength23Q4 = length23DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength23Q4 = (sumLength23Q4 / length23DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength23Q4);
            document.getElementById("length23DataQ4").innerHTML = averageLength23Q4; // 結果画面への表示


            // Q5_自己成長
            const length23DataQ5Arr = []; //length23DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "2-3年") {
                    length23Data.push(x);  //"2-3年"を選択した回答者のデータ取り出し
                    const length23AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    length23DataQ5Arr.push(length23AnswerQ5);
                }
            });
            console.log(length23DataQ5Arr);
            let sumLength23Q5 = length23DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength23Q5 = (sumLength23Q5 / length23DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength23Q5);
            document.getElementById("length23DataQ5").innerHTML = averageLength23Q5; // 結果画面への表示


            // Q6_人間関係
            const length23DataQ6Arr = []; //length23DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "2-3年") {
                    length23Data.push(x);  //"2-3年"を選択した回答者のデータ取り出し
                    const length23AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    length23DataQ6Arr.push(length23AnswerQ6);
                }
            });
            console.log(length23DataQ6Arr);
            let sumLength23Q6 = length23DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength23Q6 = (sumLength23Q6 / length23DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength23Q6);
            document.getElementById("length23DataQ6").innerHTML = averageLength23Q6; // 結果画面への表示


            // Q7_理念への共感
            const length23DataQ7Arr = []; //length23DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "2-3年") {
                    length23Data.push(x);  //"2-3年"を選択した回答者のデータ取り出し
                    const length23AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    length23DataQ7Arr.push(length23AnswerQ7);
                }
            });
            console.log(length23DataQ7Arr);
            let sumLength23Q7 = length23DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength23Q7 = (sumLength23Q7 / length23DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength23Q7);
            document.getElementById("length23DataQ7").innerHTML = averageLength23Q7; // 結果画面への表示



            // -----勤続年数_3年以上-----

            const length3Data = [];

            // Q2_労働時間
            const length3DataQ2Arr = []; //length3DataのQ2を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "3年以上") {
                    length3Data.push(x);  //"3年以上"を選択した回答者のデータ取り出し
                    const length3AnswerQ2 = x.q2; //ageDataの中のQ2の値を取得
                    length3DataQ2Arr.push(length3AnswerQ2);
                }
            });
            console.log(length3DataQ2Arr);
            let sumLength3Q2 = length3DataQ2Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength3Q2 = (sumLength3Q2 / length3DataQ2Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength3Q2);
            document.getElementById("length3DataQ2").innerHTML = averageLength3Q2; // 結果画面への表示


            // Q3_報酬
            const length3DataQ3Arr = []; //length3DataのQ3を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "3年以上") {
                    length3Data.push(x);  //"3年以上"を選択した回答者のデータ取り出し
                    const length3AnswerQ3 = x.q3; //ageDataの中のQ3の値を取得
                    length3DataQ3Arr.push(length3AnswerQ3);
                }
            });
            console.log(length3DataQ3Arr);
            let sumLength3Q3 = length3DataQ3Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength3Q3 = (sumLength3Q3 / length3DataQ3Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength3Q3);
            document.getElementById("length3DataQ3").innerHTML = averageLength3Q3; // 結果画面への表示


            // Q4_仕事のやりがい
            const length3DataQ4Arr = []; //length3DataのQ4を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "3年以上") {
                    length3Data.push(x);  //"3年以上"を選択した回答者のデータ取り出し
                    const length3AnswerQ4 = x.q4; //ageDataの中のQ4の値を取得
                    length3DataQ4Arr.push(length3AnswerQ4);
                }
            });
            console.log(length3DataQ4Arr);
            let sumLength3Q4 = length3DataQ4Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength3Q4 = (sumLength3Q4 / length3DataQ4Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength3Q4);
            document.getElementById("length3DataQ4").innerHTML = averageLength3Q4; // 結果画面への表示


            // Q5_自己成長
            const length3DataQ5Arr = []; //length3DataのQ5を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "3年以上") {
                    length3Data.push(x);  //"3年以上"を選択した回答者のデータ取り出し
                    const length3AnswerQ5 = x.q5; //ageDataの中のQ5の値を取得
                    length3DataQ5Arr.push(length3AnswerQ5);
                }
            });
            console.log(length3DataQ5Arr);
            let sumLength3Q5 = length3DataQ5Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength3Q5 = (sumLength3Q5 / length3DataQ5Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength3Q5);
            document.getElementById("length3DataQ5").innerHTML = averageLength3Q5; // 結果画面への表示


            // Q6_人間関係
            const length3DataQ6Arr = []; //length3DataのQ6を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "3年以上") {
                    length3Data.push(x);  //"3年以上"を選択した回答者のデータ取り出し
                    const length3AnswerQ6 = x.q6; //ageDataの中のQ6の値を取得
                    length3DataQ6Arr.push(length3AnswerQ6);
                }
            });
            console.log(length3DataQ6Arr);
            let sumLength3Q6 = length3DataQ6Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength3Q6 = (sumLength3Q6 / length3DataQ6Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength3Q6);
            document.getElementById("length3DataQ6").innerHTML = averageLength3Q6; // 結果画面への表示


            // Q7_理念への共感
            const length3DataQ7Arr = []; //length3DataのQ7を入れる箱
            fireAllData.forEach(x => {
                if (x.length === "3年以上") {
                    length3Data.push(x);  //"3年以上"を選択した回答者のデータ取り出し
                    const length3AnswerQ7 = x.q7; //ageDataの中のQ7の値を取得
                    length3DataQ7Arr.push(length3AnswerQ7);
                }
            });
            console.log(length3DataQ7Arr);
            let sumLength3Q7 = length3DataQ7Arr.reduce((a, b) => { //回答の値の総和
                return a + b;
            });
            const averageLength3Q7 = (sumLength3Q7 / length3DataQ7Arr.length).toFixed(1) //平均点の算出&小数第1位までで四捨五入
            console.log(averageLength3Q7);
            document.getElementById("length3DataQ7").innerHTML = averageLength3Q7; // 結果画面への表示





        // -----------------------------------------chart-----------------------------------------

        // -----------------eNPS推移-----------------

        // グラフdata用
        const transitionGetDataQ1_202204_chart = document.getElementById("transitionGetDataQ1_202204").textContent;
        const transitionGetDataQ1_202207_chart = document.getElementById("transitionGetDataQ1_202207").textContent;
        const transitionGetDataQ1_202210_chart = document.getElementById("transitionGetDataQ1_202210").textContent;

        // グラフ
        const ctx_transition = document.getElementById('chartTransition');
        new Chart(ctx_transition, {
            type: 'line',
            data: {
                labels: ['2022年4月', '2022年7月', '2022年10月'],
                datasets: [{
                    label: '推移',
                    data: [transitionGetDataQ1_202204_chart, transitionGetDataQ1_202207_chart, transitionGetDataQ1_202210_chart],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10,
                        min: 0,
                    }
                }
            }
        });



        // -----------------総合満足度-----------------

        // グラフdata用
        const GetDataQ2 = document.getElementById("GetDataQ2").textContent;
        const GetDataQ3 = document.getElementById("GetDataQ3").textContent;
        const GetDataQ4 = document.getElementById("GetDataQ4").textContent;
        const GetDataQ5 = document.getElementById("GetDataQ5").textContent;
        const GetDataQ6 = document.getElementById("GetDataQ6").textContent;
        const GetDataQ7 = document.getElementById("GetDataQ7").textContent;

        // グラフ
        const ctx = document.getElementById('chart1');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '総合満足度',
                    data: [GetDataQ2, GetDataQ3, GetDataQ4, GetDataQ5, GetDataQ6, GetDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // -----------------属性ごとの満足度-----------------

        // ----------性別_女性----------
        // グラフdata用
        const genderFemaleDataQ2 = document.getElementById("genderFemaleDataQ2").textContent;
        const genderFemaleDataQ3 = document.getElementById("genderFemaleDataQ3").textContent;
        const genderFemaleDataQ4 = document.getElementById("genderFemaleDataQ4").textContent;
        const genderFemaleDataQ5 = document.getElementById("genderFemaleDataQ5").textContent;
        const genderFemaleDataQ6 = document.getElementById("genderFemaleDataQ6").textContent;
        const genderFemaleDataQ7 = document.getElementById("genderFemaleDataQ7").textContent;

        // グラフ
        const ctx2 = document.getElementById('chartFemale');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '女性',
                    data: [genderFemaleDataQ2, genderFemaleDataQ3, genderFemaleDataQ4, genderFemaleDataQ5, genderFemaleDataQ6, genderFemaleDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------性別_男性----------

        // グラフdata用
        const genderMaleDataQ2 = document.getElementById("genderMaleDataQ2").textContent;
        const genderMaleDataQ3 = document.getElementById("genderMaleDataQ3").textContent;
        const genderMaleDataQ4 = document.getElementById("genderMaleDataQ4").textContent;
        const genderMaleDataQ5 = document.getElementById("genderMaleDataQ5").textContent;
        const genderMaleDataQ6 = document.getElementById("genderMaleDataQ6").textContent;
        const genderMaleDataQ7 = document.getElementById("genderMaleDataQ7").textContent;


        // グラフ
        const ctx3 = document.getElementById('chartMale');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '男性',
                    data: [genderMaleDataQ2, genderMaleDataQ3, genderMaleDataQ4, genderMaleDataQ5, genderMaleDataQ6, genderMaleDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------年齢_20代----------
        // グラフdata用
        const age20DataQ2 = document.getElementById("age20DataQ2").textContent;
        const age20DataQ3 = document.getElementById("age20DataQ3").textContent;
        const age20DataQ4 = document.getElementById("age20DataQ4").textContent;
        const age20DataQ5 = document.getElementById("age20DataQ5").textContent;
        const age20DataQ6 = document.getElementById("age20DataQ6").textContent;
        const age20DataQ7 = document.getElementById("age20DataQ7").textContent;

        // グラフ
        const ctx4 = document.getElementById('chart20');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '20代',
                    data: [age20DataQ2, age20DataQ3, age20DataQ4, age20DataQ5, age20DataQ6, age20DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------年齢_30代----------
        // グラフdata用
        const age30DataQ2 = document.getElementById("age30DataQ2").textContent;
        const age30DataQ3 = document.getElementById("age30DataQ3").textContent;
        const age30DataQ4 = document.getElementById("age30DataQ4").textContent;
        const age30DataQ5 = document.getElementById("age30DataQ5").textContent;
        const age30DataQ6 = document.getElementById("age30DataQ6").textContent;
        const age30DataQ7 = document.getElementById("age30DataQ7").textContent;

        // グラフ
        const ctx5 = document.getElementById('chart30');
        new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '30代',
                    data: [age30DataQ2, age30DataQ3, age30DataQ4, age30DataQ5, age30DataQ6, age30DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------年齢_40代----------
        // グラフdata用
        const age40DataQ2 = document.getElementById("age40DataQ2").textContent;
        const age40DataQ3 = document.getElementById("age40DataQ3").textContent;
        const age40DataQ4 = document.getElementById("age40DataQ4").textContent;
        const age40DataQ5 = document.getElementById("age40DataQ5").textContent;
        const age40DataQ6 = document.getElementById("age40DataQ6").textContent;
        const age40DataQ7 = document.getElementById("age40DataQ7").textContent;

        // グラフ
        const ctx6 = document.getElementById('chart40');
        new Chart(ctx6, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '40代',
                    data: [age40DataQ2, age40DataQ3, age40DataQ4, age40DataQ5, age40DataQ6, age40DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------年齢_50代----------
        // グラフdata用
        const age50DataQ2 = document.getElementById("age50DataQ2").textContent;
        const age50DataQ3 = document.getElementById("age50DataQ3").textContent;
        const age50DataQ4 = document.getElementById("age50DataQ4").textContent;
        const age50DataQ5 = document.getElementById("age50DataQ5").textContent;
        const age50DataQ6 = document.getElementById("age50DataQ6").textContent;
        const age50DataQ7 = document.getElementById("age50DataQ7").textContent;

        // グラフ
        const ctx7 = document.getElementById('chart50');
        new Chart(ctx7, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '50代',
                    data: [age50DataQ2, age50DataQ3, age50DataQ4, age50DataQ5, age50DataQ6, age50DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------所属_的場店----------
        // グラフdata用
        const affiliationMatobaDataQ2 = document.getElementById("affiliationMatobaDataQ2").textContent;
        const affiliationMatobaDataQ3 = document.getElementById("affiliationMatobaDataQ3").textContent;
        const affiliationMatobaDataQ4 = document.getElementById("affiliationMatobaDataQ4").textContent;
        const affiliationMatobaDataQ5 = document.getElementById("affiliationMatobaDataQ5").textContent;
        const affiliationMatobaDataQ6 = document.getElementById("affiliationMatobaDataQ6").textContent;
        const affiliationMatobaDataQ7 = document.getElementById("affiliationMatobaDataQ7").textContent;

        // グラフ
        const ctx8 = document.getElementById('chartMatoba');
        new Chart(ctx8, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '的場店',
                    data: [affiliationMatobaDataQ2, affiliationMatobaDataQ3, affiliationMatobaDataQ4, affiliationMatobaDataQ5, affiliationMatobaDataQ6, affiliationMatobaDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------所属_次郎丸店----------
        // グラフdata用
        const affiliationJiromaruDataQ2 = document.getElementById("affiliationJiromaruDataQ2").textContent;
        const affiliationJiromaruDataQ3 = document.getElementById("affiliationJiromaruDataQ3").textContent;
        const affiliationJiromaruDataQ4 = document.getElementById("affiliationJiromaruDataQ4").textContent;
        const affiliationJiromaruDataQ5 = document.getElementById("affiliationJiromaruDataQ5").textContent;
        const affiliationJiromaruDataQ6 = document.getElementById("affiliationJiromaruDataQ6").textContent;
        const affiliationJiromaruDataQ7 = document.getElementById("affiliationJiromaruDataQ7").textContent;

        // グラフ
        const ctx9 = document.getElementById('chartJiromaru');
        new Chart(ctx9, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '次郎丸店',
                    data: [affiliationJiromaruDataQ2, affiliationJiromaruDataQ3, affiliationJiromaruDataQ4, affiliationJiromaruDataQ5, affiliationJiromaruDataQ6, affiliationJiromaruDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------職種_看護師----------
        // グラフdata用
        const occupationNurseDataQ2 = document.getElementById("occupationNurseDataQ2").textContent;
        const occupationNurseDataQ3 = document.getElementById("occupationNurseDataQ3").textContent;
        const occupationNurseDataQ4 = document.getElementById("occupationNurseDataQ4").textContent;
        const occupationNurseDataQ5 = document.getElementById("occupationNurseDataQ5").textContent;
        const occupationNurseDataQ6 = document.getElementById("occupationNurseDataQ6").textContent;
        const occupationNurseDataQ7 = document.getElementById("occupationNurseDataQ7").textContent;

        // グラフ
        const ctx10 = document.getElementById('chartNurse');
        new Chart(ctx10, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '看護師',
                    data: [occupationNurseDataQ2, occupationNurseDataQ3, occupationNurseDataQ4, occupationNurseDataQ5, occupationNurseDataQ6, occupationNurseDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------職種_セラピスト----------
        // グラフdata用
        const occupationTherapistDataQ2 = document.getElementById("occupationTherapistDataQ2").textContent;
        const occupationTherapistDataQ3 = document.getElementById("occupationTherapistDataQ3").textContent;
        const occupationTherapistDataQ4 = document.getElementById("occupationTherapistDataQ4").textContent;
        const occupationTherapistDataQ5 = document.getElementById("occupationTherapistDataQ5").textContent;
        const occupationTherapistDataQ6 = document.getElementById("occupationTherapistDataQ6").textContent;
        const occupationTherapistDataQ7 = document.getElementById("occupationTherapistDataQ7").textContent;

        // グラフ
        const ctx11 = document.getElementById('chartTherapist');
        new Chart(ctx11, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: 'セラピスト',
                    data: [occupationTherapistDataQ2, occupationTherapistDataQ3, occupationTherapistDataQ4, occupationTherapistDataQ5, occupationTherapistDataQ6, occupationTherapistDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------職種_事務----------
        // グラフdata用
        const occupationClerkDataQ2 = document.getElementById("occupationClerkDataQ2").textContent;
        const occupationClerkDataQ3 = document.getElementById("occupationClerkDataQ3").textContent;
        const occupationClerkDataQ4 = document.getElementById("occupationClerkDataQ4").textContent;
        const occupationClerkDataQ5 = document.getElementById("occupationClerkDataQ5").textContent;
        const occupationClerkDataQ6 = document.getElementById("occupationClerkDataQ6").textContent;
        const occupationClerkDataQ7 = document.getElementById("occupationClerkDataQ7").textContent;

        // グラフ
        const ctx12 = document.getElementById('chartClerk');
        new Chart(ctx12, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '事務',
                    data: [occupationClerkDataQ2, occupationClerkDataQ3, occupationClerkDataQ4, occupationClerkDataQ5, occupationClerkDataQ6, occupationClerkDataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------勤続年数_1年未満----------
        // グラフdata用
        const length1DataQ2 = document.getElementById("length1DataQ2").textContent;
        const length1DataQ3 = document.getElementById("length1DataQ3").textContent;
        const length1DataQ4 = document.getElementById("length1DataQ4").textContent;
        const length1DataQ5 = document.getElementById("length1DataQ5").textContent;
        const length1DataQ6 = document.getElementById("length1DataQ6").textContent;
        const length1DataQ7 = document.getElementById("length1DataQ7").textContent;

        // グラフ
        const ctx13 = document.getElementById('chartLength1');
        new Chart(ctx13, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '1年未満',
                    data: [length1DataQ2, length1DataQ3, length1DataQ4, length1DataQ5, length1DataQ6, length1DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------勤続年数_1-2年----------
        // グラフdata用
        const length12DataQ2 = document.getElementById("length12DataQ2").textContent;
        const length12DataQ3 = document.getElementById("length12DataQ3").textContent;
        const length12DataQ4 = document.getElementById("length12DataQ4").textContent;
        const length12DataQ5 = document.getElementById("length12DataQ5").textContent;
        const length12DataQ6 = document.getElementById("length12DataQ6").textContent;
        const length12DataQ7 = document.getElementById("length12DataQ7").textContent;

        // グラフ
        const ctx14 = document.getElementById('chartLength12');
        new Chart(ctx14, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '1-2年',
                    data: [length12DataQ2, length12DataQ3, length12DataQ4, length12DataQ5, length12DataQ6, length12DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------勤続年数_2-3年----------
        // グラフdata用
        const length23DataQ2 = document.getElementById("length23DataQ2").textContent;
        const length23DataQ3 = document.getElementById("length23DataQ3").textContent;
        const length23DataQ4 = document.getElementById("length23DataQ4").textContent;
        const length23DataQ5 = document.getElementById("length23DataQ5").textContent;
        const length23DataQ6 = document.getElementById("length23DataQ6").textContent;
        const length23DataQ7 = document.getElementById("length23DataQ7").textContent;

        // グラフ
        const ctx15 = document.getElementById('chartLength23');
        new Chart(ctx15, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '2-3年',
                    data: [length23DataQ2, length23DataQ3, length23DataQ4, length23DataQ5, length23DataQ6, length23DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------勤続年数_3年以上----------
        // グラフdata用
        const length3DataQ2 = document.getElementById("length3DataQ2").textContent;
        const length3DataQ3 = document.getElementById("length3DataQ3").textContent;
        const length3DataQ4 = document.getElementById("length3DataQ4").textContent;
        const length3DataQ5 = document.getElementById("length3DataQ5").textContent;
        const length3DataQ6 = document.getElementById("length3DataQ6").textContent;
        const length3DataQ7 = document.getElementById("length3DataQ7").textContent;

        // グラフ
        const ctx16 = document.getElementById('chartLength3');
        new Chart(ctx16, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '3年以上',
                    data: [length3DataQ2, length3DataQ3, length3DataQ4, length3DataQ5, length3DataQ6, length3DataQ7],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        //--------------------属性ごとの比較-------------------------------------------

        // ----------性別----------
        // グラフ
        const ctx_gender = document.getElementById('chart_comparison1');
        new Chart(ctx_gender, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '女性',
                    data: [genderFemaleDataQ2, genderFemaleDataQ3, genderFemaleDataQ4, genderFemaleDataQ5, genderFemaleDataQ6, genderFemaleDataQ7],
                    borderWidth: 1
                }, {
                    label: '男性',
                    data: [genderMaleDataQ2, genderMaleDataQ3, genderMaleDataQ4, genderMaleDataQ5, genderMaleDataQ6, genderMaleDataQ7],
                    borderWidth: 1
                }
                ],
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------年齢----------         
        // グラフ
        const ctx_age = document.getElementById('chart_comparison2');
        new Chart(ctx_age, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '20代',
                    data: [age20DataQ2, age20DataQ3, age20DataQ4, age20DataQ5, age20DataQ6, age20DataQ7],
                    borderWidth: 1
                }, {
                    label: '30代',
                    data: [age30DataQ2, age30DataQ3, age30DataQ4, age30DataQ5, age30DataQ6, age30DataQ7],
                    borderWidth: 1
                }, {
                    label: '40代',
                    data: [age40DataQ2, age40DataQ3, age40DataQ4, age40DataQ5, age40DataQ6, age40DataQ7],
                    borderWidth: 1
                }, {
                    label: '50代',
                    data: [age50DataQ2, age50DataQ3, age50DataQ4, age50DataQ5, age50DataQ6, age50DataQ7],
                    borderWidth: 1
                }
                ],
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------所属---------- 
        // グラフ
        const ctx_affiliation = document.getElementById('chart_comparison3');
        new Chart(ctx_affiliation, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '的場店',
                    data: [affiliationMatobaDataQ2, affiliationMatobaDataQ3, affiliationMatobaDataQ4, affiliationMatobaDataQ5, affiliationMatobaDataQ6, affiliationMatobaDataQ7],
                    borderWidth: 1
                }, {
                    label: '次郎丸店',
                    data: [affiliationJiromaruDataQ2, affiliationJiromaruDataQ3, affiliationJiromaruDataQ4, affiliationJiromaruDataQ5, affiliationJiromaruDataQ6, affiliationJiromaruDataQ7],
                    borderWidth: 1
                }],
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------職種---------- 
        // グラフ
        const ctx_occupation = document.getElementById('chart_comparison4');
        new Chart(ctx_occupation, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '看護師',
                    data: [occupationNurseDataQ2, occupationNurseDataQ3, occupationNurseDataQ4, occupationNurseDataQ5, occupationNurseDataQ6, occupationNurseDataQ7],
                    borderWidth: 1
                }, {
                    label: 'セラピスト',
                    data: [occupationTherapistDataQ2, occupationTherapistDataQ3, occupationTherapistDataQ4, occupationTherapistDataQ5, occupationTherapistDataQ6, occupationTherapistDataQ7],
                    borderWidth: 1
                }, {
                    label: '事務',
                    data: [occupationClerkDataQ2, occupationClerkDataQ3, occupationClerkDataQ4, occupationClerkDataQ5, occupationClerkDataQ6, occupationClerkDataQ7],
                    borderWidth: 1
                }
                ],
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });



        // ----------勤続年数---------- 
        // グラフ
        const ctx_lengh = document.getElementById('chart_comparison5');
        new Chart(ctx_lengh, {
            type: 'bar',
            data: {
                labels: ['労働時間', '報酬', '仕事のやりがい', '自己成長', '人間関係', '理念への共感'],
                datasets: [{
                    label: '1年未満',
                    data: [length1DataQ2, length1DataQ3, length1DataQ4, length1DataQ5, length1DataQ6, length1DataQ7],
                    borderWidth: 1
                }, {
                    label: '1-2年',
                    data: [length12DataQ2, length12DataQ3, length12DataQ4, length12DataQ5, length12DataQ6, length12DataQ7],
                    borderWidth: 1
                }, {
                    label: '2-3年',
                    data: [length23DataQ2, length23DataQ3, length23DataQ4, length23DataQ5, length23DataQ6, length23DataQ7],
                    borderWidth: 1
                }, {
                    label: '3年以上',
                    data: [length3DataQ2, length3DataQ3, length3DataQ4, length3DataQ5, length3DataQ6, length3DataQ7],
                    borderWidth: 1
                }
                ],
            },
            options: {
                scales: {
                    y: {
                        max: 10
                    }
                }
            }
        });
    </script>

</body>
</html>