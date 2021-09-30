function test(){
    // $.ajax({
    //     type: 'post',
    //     url: '../template/test_2.php',
    //     success: function (response){
    //         console.log('done test');
    //         console.log(response);
    //     }
    // });
    console.log('test');
    setTimeout("test()",500);
}
test();