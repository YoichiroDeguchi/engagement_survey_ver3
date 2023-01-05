<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>engagement survey</title>
</head>
<body>
    <div id="explanationBox" class="fit">
        <!-- 回答する前に -->
        <div class="explanation_title">
            <h2 class="text-center">回答する前にお読みください</h2>
        </div>
        <h3>調査の目的</h3>
        <p>この調査はチームの状況を把握し、より良いチームへと改善していくために実施します。</p>

        <h3>調査の方針</h3>
        <p>完全匿名性で実施します。<br>
            回答者個人がどのような回答をしたかの特定は行いません。</p>

        <h3>回答手順</h3>
        <p>属性情報入力の後に設問が始まります。<br>
            設問をよく読み、選択肢の中から自分の今の状態に近いものを選んでください。<br>
            回答目安時間は3分です。</p>
        <a href="#attributeBox" class="next_btn explanation_btn explanation_btn2">回答を始める</a>
    </div>

<form action="submit.php" method="post">
    <div id="attributeBox" style="display: none;">
        <!-- 属性 -->
        <div class="attribute_title">
            <h2 class="text-center">はじめにあなたの属性についてお伺いします。</h2>
        </div>
        <p>回答月</p>
        <select name="year" id="year">
            <option value="2022年4月">2022年4月</option>
            <option value="2022年7月">2022年7月</option>
            <option value="2022年10月">2022年10月</option>
        </select>
        <p>性別</p>
        <input type="radio" name="gender" value="男性" required>男性
        <input type="radio" name="gender" value="女性">女性
        <p>年齢</p>
        <input type="radio" name="age" value="20代" required>20代
        <input type="radio" name="age" value="30代">30代
        <input type="radio" name="age" value="40代">40代
        <input type="radio" name="age" value="50代">50代
        <p>所属</p>
        <input type="radio" name="affiliation" value="的場店" required>的場店
        <input type="radio" name="affiliation" value="次郎丸店">次郎丸店
        <p>職種</p>
        <input type="radio" name="occupation" value="看護師" required>看護師
        <input type="radio" name="occupation" value="セラピスト">セラピスト
        <input type="radio" name="occupation" value="事務">事務
        <p>勤続年数</p>
        <input type="radio" name="length" value="1年未満" required>1年未満
        <input type="radio" name="length" value="1-2年">1-2年
        <input type="radio" name="length" value="2-3年">2-3年
        <input type="radio" name="length" value="3年以上">3年以上

        <a href="#questionBox" class="next_btn attribute_btn attribute_btn2">進む</a>
    </div>

    <div id="questionBox" style="display: none;">
        <!-- 設問スタート -->
        <div class="question_title">
            <h2 class="text-center">以下の設問にご回答ください。</h2>
        </div>
        <p>01　あなたは現在の職場を親しい知人や友人にどの程度おすすめしたいと思いますか？</p>
        <input type="radio" name="q1" value="0" required>0 全く思わない
        <input type="radio" name="q1" value="1">1
        <input type="radio" name="q1" value="2">2
        <input type="radio" name="q1" value="3">3
        <input type="radio" name="q1" value="4">4
        <input type="radio" name="q1" value="5">5 どちらでもない
        <input type="radio" name="q1" value="6">6
        <input type="radio" name="q1" value="7">7
        <input type="radio" name="q1" value="8">8
        <input type="radio" name="q1" value="9">9
        <input type="radio" name="q1" value="10">10 非常にそう思う

        <p>02　労働時間には満足していますか？</p>
        <input type="radio" name="q2" value="0" required>0 全く思わない
        <input type="radio" name="q2" value="1">1
        <input type="radio" name="q2" value="2">2
        <input type="radio" name="q2" value="3">3
        <input type="radio" name="q2" value="4">4
        <input type="radio" name="q2" value="5">5 どちらでもない
        <input type="radio" name="q2" value="6">6
        <input type="radio" name="q2" value="7">7
        <input type="radio" name="q2" value="8">8
        <input type="radio" name="q2" value="9">9
        <input type="radio" name="q2" value="10">10 非常にそう思う

        <p>03　正当な報酬をもらっていると感じていますか？</p>
        <input type="radio" name="q3" value="0" required>0 全く思わない
        <input type="radio" name="q3" value="1">1
        <input type="radio" name="q3" value="2">2
        <input type="radio" name="q3" value="3">3
        <input type="radio" name="q3" value="4">4
        <input type="radio" name="q3" value="5">5 どちらでもない
        <input type="radio" name="q3" value="6">6
        <input type="radio" name="q3" value="7">7
        <input type="radio" name="q3" value="8">8
        <input type="radio" name="q3" value="9">9
        <input type="radio" name="q3" value="10">10 非常にそう思う

        <p>04　自分の仕事内容そのものにやりがいを感じていますか？</p>
        <input type="radio" name="q4" value="0" required>0 全く思わない
        <input type="radio" name="q4" value="1">1
        <input type="radio" name="q4" value="2">2
        <input type="radio" name="q4" value="3">3
        <input type="radio" name="q4" value="4">4
        <input type="radio" name="q4" value="5">5 どちらでもない
        <input type="radio" name="q4" value="6">6
        <input type="radio" name="q4" value="7">7
        <input type="radio" name="q4" value="8">8
        <input type="radio" name="q4" value="9">9
        <input type="radio" name="q4" value="10">10 非常にそう思う

        <p>05　自分の成長を実感できていますか？</p>
        <input type="radio" name="q5" value="0" required>0 全く思わない
        <input type="radio" name="q5" value="1">1
        <input type="radio" name="q5" value="2">2
        <input type="radio" name="q5" value="3">3
        <input type="radio" name="q5" value="4">4
        <input type="radio" name="q5" value="5">5 どちらでもない
        <input type="radio" name="q5" value="6">6
        <input type="radio" name="q5" value="7">7
        <input type="radio" name="q5" value="8">8
        <input type="radio" name="q5" value="9">9
        <input type="radio" name="q5" value="10">10 非常にそう思う

        <p>06　チームメンバーとの関係は良好ですか？</p>
        <input type="radio" name="q6" value="0" required>0 全く思わない
        <input type="radio" name="q6" value="1">1
        <input type="radio" name="q6" value="2">2
        <input type="radio" name="q6" value="3">3
        <input type="radio" name="q6" value="4">4
        <input type="radio" name="q6" value="5">5 どちらでもない
        <input type="radio" name="q6" value="6">6
        <input type="radio" name="q6" value="7">7
        <input type="radio" name="q6" value="8">8
        <input type="radio" name="q6" value="9">9
        <input type="radio" name="q6" value="10">10 非常にそう思う

        <p>07　会社の理念に共感していますか？</p>
        <input type="radio" name="q7" value="0" required>0 全く思わない
        <input type="radio" name="q7" value="1">1
        <input type="radio" name="q7" value="2">2
        <input type="radio" name="q7" value="3">3
        <input type="radio" name="q7" value="4">4
        <input type="radio" name="q7" value="5">5 どちらでもない
        <input type="radio" name="q7" value="6">6
        <input type="radio" name="q7" value="7">7
        <input type="radio" name="q7" value="8">8
        <input type="radio" name="q7" value="9">9
        <input type="radio" name="q7" value="10">10 非常にそう思う

        <input type="submit" class="question_btn question_btn2" id="end_btn">
    </div>
</form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="main.js"></script>

</body>
</html>