//次へボタンを押したら画面切り替え
$(function () {
    $(".next_btn").on("click", function () { //btnクラスをクリック後の関数処理
        $(this).closest("div").css("display", "none"); //質問画面にあたらる親要素divをdisplay:none;にする
        id = $(this).attr("href"); //次の質問hrefをidに格納
        $(id).addClass("fit").fadeIn("slow").show(); //次の質問にfitをつけて出力。
    });
});


// 質問ページのURLコピー
document.getElementById("copy-page").onclick = function () {
    $(document.body).append("<textarea id=\"copyTarget\" style=\"position:absolute; left:-9999px; top:0px;\" readonly=\"readonly\">" + location.href + "</textarea>");
    let obj = document.getElementById("copyTarget");
    let range = document.createRange();
    range.selectNode(obj);
    window.getSelection().addRange(range);
    document.execCommand('copy');
    document.getElementById("cAction").innerHTML = "コピーしました";
};



// -------------------------属性ごとの満足度-------------------------
// function change() {
//     if (document.getElementById("optionBox")) {
//         selboxValue = document.getElementById("optionBox").value;

//         if (selboxValue == "optionFemale") {
//             //女性を表示
//             document.getElementById("genderFemaleBox").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionMale") {
//             //男性を表示
//             document.getElementById("genderMaleBox").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "option20") {
//             //20代を表示
//             document.getElementById("age20Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "option30") {
//             //30代を表示
//             document.getElementById("age30Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "option40") {
//             //40代を表示
//             document.getElementById("age40Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "option50") {
//             //50代を表示
//             document.getElementById("age50Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionMatoba") {
//             //的場店を表示
//             document.getElementById("affiliationMatobaBox").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionJiromaru") {
//             //次郎丸店を表示
//             document.getElementById("affiliationJiromaruBox").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionNurse") {
//             //看護師を表示
//             document.getElementById("occupationNurseBox").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionTherapist") {
//             //セラピストを表示
//             document.getElementById("occupationTherapistBox").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionClerk") {
//             //事務を表示
//             document.getElementById("occupationClerkBox").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionLength1") {
//             //1年未満を表示
//             document.getElementById("length1Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionLength12") {
//             //1-2年を表示
//             document.getElementById("length12Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionLength23") {
//             //2-3年を表示
//             document.getElementById("length23Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length3Box").style.display = "none";

//         } if (selboxValue == "optionLength3") {
//             //3年を表示
//             document.getElementById("length3Box").style.display = "";
//             //それ以外を非表示
//             document.getElementById("genderFemaleBox").style.display = "none";
//             document.getElementById("genderMaleBox").style.display = "none";
//             document.getElementById("age20Box").style.display = "none";
//             document.getElementById("age30Box").style.display = "none";
//             document.getElementById("age40Box").style.display = "none";
//             document.getElementById("age50Box").style.display = "none";
//             document.getElementById("affiliationMatobaBox").style.display = "none";
//             document.getElementById("affiliationJiromaruBox").style.display = "none";
//             document.getElementById("occupationNurseBox").style.display = "none";
//             document.getElementById("occupationTherapistBox").style.display = "none";
//             document.getElementById("occupationClerkBox").style.display = "none";
//             document.getElementById("length1Box").style.display = "none";
//             document.getElementById("length12Box").style.display = "none";
//             document.getElementById("length23Box").style.display = "none";
//         }
//     }
// }



// -------------------------属性ごとの比較-------------------------
function change() {
    if (document.getElementById("comparisonBox")) {
        selboxValue2 = document.getElementById("comparisonBox").value;

        if (selboxValue2 == "comparisonGender") {
            //性別を表示
            document.getElementById("chart_comparison1").style.display = "";
            //それ以外を非表示
            document.getElementById("chart_comparison2").style.display = "none";
            document.getElementById("chart_comparison3").style.display = "none";
            document.getElementById("chart_comparison4").style.display = "none";
            document.getElementById("chart_comparison5").style.display = "none";

        } if (selboxValue2 == "comparisonAge") {
            //年齢を表示
            document.getElementById("chart_comparison2").style.display = "";
            //それ以外を非表示
            document.getElementById("chart_comparison1").style.display = "none";
            document.getElementById("chart_comparison3").style.display = "none";
            document.getElementById("chart_comparison4").style.display = "none";
            document.getElementById("chart_comparison5").style.display = "none";

        } if (selboxValue2 == "comparisonAffiliation") {
            //所属を表示
            document.getElementById("chart_comparison3").style.display = "";
            //それ以外を非表示
            document.getElementById("chart_comparison1").style.display = "none";
            document.getElementById("chart_comparison2").style.display = "none";
            document.getElementById("chart_comparison4").style.display = "none";
            document.getElementById("chart_comparison5").style.display = "none";

        } if (selboxValue2 == "comparisonOccupation") {
            //職種を表示
            document.getElementById("chart_comparison4").style.display = "";
            //それ以外を非表示
            document.getElementById("chart_comparison1").style.display = "none";
            document.getElementById("chart_comparison2").style.display = "none";
            document.getElementById("chart_comparison3").style.display = "none";
            document.getElementById("chart_comparison5").style.display = "none";

        } if (selboxValue2 == "comparisonLength") {
            //職種を表示
            document.getElementById("chart_comparison5").style.display = "";
            //それ以外を非表示
            document.getElementById("chart_comparison1").style.display = "none";
            document.getElementById("chart_comparison2").style.display = "none";
            document.getElementById("chart_comparison3").style.display = "none";
            document.getElementById("chart_comparison4").style.display = "none";
        }
    }
}