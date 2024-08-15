$(function (){
    $('#ReviewMassage').fadeTo(10000,5000).slideUp(500,function(){
        $('#ReviewMassage').slideUp(500);
    });
});
$(function (){
    $('#PatientMassage').fadeTo(10000,5000).slideUp(500,function(){
        $('#PatientMassage').slideUp(500);
    });
});
$(function (){
    $('#AlertMessage').fadeTo(10000,5000).slideUp(500,function(){
        $('#AlertMessage').slideUp(500);
    });
});
const speakbtns = document.querySelectorAll(".speake");
const texts = document.querySelectorAll(".VoiceToText");

speakbtns.forEach((speakbtn, index) => {
    speakbtn.addEventListener("click", () => {
        let recog = new webkitSpeechRecognition();
        recog.lang = "ar";
        recog.onresult = (eve) => {
            texts[index].value = eve.results[0][0].transcript;
        };
        recog.start();
    });
});

//-------------------clock-----------

    // function checkTime(x) {
    //     if (x<10) {
    //         x= "0"+x;
    //     }
    //     return x;
    // }
    // function checkHour(x) {
    //     if (x==0) {
    //         x= 12;
    //     a='AM';
    //     }else if(x<=11){
    //         if (x<10) {
    //             x= "0"+x;
    //         }else if(x==11){
    //             x= x;
    //         }
    //         a='AM';
    //     }else if(x>11){
    //         if (x==12){
    //             x=x;
    //         }else{
    //             x= x-12;
    //             x= "0"+x;
    //         }
            
    //         a='PM';
    //     }
    //     return x;
    // }
    // function myWatch(){
    //     var date = new Date();
    //     var hour = date.getHours();
    //     var min = date.getMinutes();
    //     var sec = date.getSeconds();
    //     hour = checkHour(hour);
    //     min = checkTime(min);
    //     sec = checkTime(sec);
    //     document.getElementById("clock").innerHTML= hour+':' +min+':' +sec +' '+ a;
    
    //     setTimeout( function () {
    //         myWatch();
    //     } ,1000);
    // }


    // window.onload = function myloaded(){
    //     myWatch();
    // }

//-------------------clock-----------