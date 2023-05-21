$(document).ready(()=>{
   
    const erroReset = () =>{
        $(document).on('click', '.input' , function(){
            $('.error').text('')
            $('.global').text('')
            $('.global').addClass('d-none')
        })
    }
    erroReset()

    const login = () =>{
        $(document).on('submit', '#loginForm' ,function(event){
            event.preventDefault();
            let form = new FormData(this);
            form.append("action", "logins");

            $.ajax({
                type: "POST",
                url: "./views/user.view.php",
                data: form,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function(){
                    $('#loginForm-submit').html('<span><i class="fa fa-spin fa-spinner" ></i> Please wait..</span>')
                    $('#loginForm-submit').attr("disabled", true);
                },
                success: function (response) {
                    if(response.status == true ){
                        if(response.verify == true ){
                            location.reload()
                        }
                        else{
                            location.href= response.message
                        }
                    }
                    else{
                        switch(response.error){
                            case "email":{
                                $('.error-email-login').text(response.message)
                                break;
                            }
                            case "password":{
                                $('.error-password-login').text(response.message)
                                break;
                            }
                            default:{
                                $('.error-global-login').removeClass('d-none')
                                $('.error-global-login').text(response.message)
                                break;
                            }
                        }
                    }
                },
                complete: function(){
                    $('#loginForm-submit').attr("disabled", false);
                    $('#loginForm-submit').html('<span>Login <i class="fa fa-arrow-right" ></i></span>')
                }
            });

        })
    }
    login()

    const loginverify = ()=>{
        $(document).on('submit', '#verificationForm' ,function(event){
            event.preventDefault()
            let form = new FormData(this);
            form.append("action", "verifyAccounts");

            $.ajax({
                type: "POST",
                url: "./views/user.view.php",
                data: form,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function (response) {
                    if(response.status == true){
                        location.reload();
                    }
                    else{
                        $('.error-global-verification-login').removeClass('d-none')
                        $(".error-global-verification-login").text(response.message)
                    }
                    console.log("mesage: "+response.message)
                }
            });

        })
    }
    loginverify()


})