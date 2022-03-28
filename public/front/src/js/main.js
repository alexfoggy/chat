
let text = ['Mail forms','Chat assistent and la la la','Emailing','Statistics','Unique users'];
let i = 0;
setInterval(function(){
    
    if(text[i] == null){
        i = 0;
        console.log(1);
    }
    else {
        $('.blockchange').css('transform','rotateX(90deg)');
        i++;
        setTimeout(function(){
            $('.blockchange').text(text[i]);
            $('.blockchange').css('transform','rotateX(0deg)');
        },1500);
    }

},4000);