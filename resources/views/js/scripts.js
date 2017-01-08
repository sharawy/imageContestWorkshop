
API_URL = "http://localhost/workshop/";
function is_logged(){
  if(sessionStorage.token){
    return sessionStorage.token;

  }else {
    return false;
  }
}
function like(id){
  token=is_logged();
  if(token){

    $.ajax({
    url: API_URL+"items/vote",
    type: 'post',
    data: {
      item_id: id,
      value : 1,
      user_id : sessionStorage.user_id,
    },
    headers: {
      "token" : token,
        "Authorization": token
    },
    dataType: 'json',
    success: function (data) {
      if(data.result){
        $(".like-"+id).html("Like ("+data.result.total+")");
      }
      else {
        alert(data.msg);
      }
    }
});
}else {
  alert("please login first");
}
}
function approve(id){
  token=is_logged();
  if(token && sessionStorage.is_staff){

    $.ajax({
    url: API_URL+"items/approve",
    type: 'post',
    data: {
      item_id: id
    },
    headers: {
      "token" : token,
        "Authorization": token
    },
    dataType: 'json',
    success: function (data) {
      if(data.result){

      }
      else {
        alert(data.msg);
      }
    }
});
}else {
  alert("please login first");
}
}
function image_element(item){
return  html ='<div class="col-lg-3 col-sm-4 col-xs-6 panel-body"><a title="'+item.name+'" href="#">'
  +'<p class="text-center">'+item.name+'</p><img class="thumbnail img-responsive" src="'+item.image_url+'"></a>'
  +'<div class="text-center"><button onClick="like('+item.id+')" class="like-'+item.id+' btn btn-success">Like ('+item.likes+')</button>'
  +'</div></div>'
}
function user_element(item){

return  html ='<tr data-status="">'
+'<td><div class="media"><a class="pull-left" href="#">'
+'</a><div class="media-body">'
+'<h4 class="title">'+item.user.full_name+'<span class="pull-right">likes ('+item.count+') </span></h4>'
+'<p class="summary">Mobile number: '+item.user.mobile_number+' || Item title: '+item.item.name+'</p></div></div></td></tr>';
}
$('a[rel*=leanModal]').leanModal({ top: -5, overlay: 0.45,position: "absolute",closeButton: ".modal_close"  });

$(document).ready(function(){/* copy loaded thumbnails into carousel */
//handling session
token=is_logged();
if (token){
  $(".loginbtn").css("display","none");
  $(".registerbtn").css("display","none");
  $("#welcome").html("Welcome "+sessionStorage.full_name);
}

File.prototype.convertToBase64 = function(callback){
           var FR= new FileReader();
           FR.onload = function(e) {
                callback(e.target.result)
           };
           FR.readAsDataURL(this);
   }
   imageBase64="";
   $("#image_url").on('change',function(){
     var selectedFile = this.files[0];
     selectedFile.convertToBase64(function(base64){
          imageBase64= base64;
     })
   });
   $("#uploadform").submit(function(event) {

                             /* stop form from submitting normally */
                             event.preventDefault();
                             token = is_logged();
                             if (!token){
                                alert("please login first");
                                return ;
                              }
                             /* get some values from elements on the page: */
                             var $form = $(this),
                                 name = $form.find('input[name="name"]').val();
                                 description = $form.find('input[name="description"]').val();
                                 image_url = imageBase64;

                                 $.ajax({
                                 url: API_URL+"items",
                                 type: 'post',
                                 data: {
                                   name : name,
                                   description: description,
                                   image_url : image_url
                                 },
                                 headers: {
                                   "token" : token,
                                     "Authorization": token
                                 },
                                 dataType: 'json',
                                 success: function (data) {
                                   $(".modal_close").click();
                                   $( image_element(data.result) ).prependTo( "#listing" );

                                 },
                                 error : function(err){
                                  alert(err.responseText);
                                 }
                             });

                         });

  function getPageName(url) {
         var index = url.lastIndexOf("/") + 1;
         var filenameWithExtension = url.substr(index);
         var filename = filenameWithExtension.split(".")[0]; // <-- added this line
         return filename;                                    // <-- added this line
     }
/* listing images  */
function getPage(url,element_type){
$.ajax({url: url, success: function(response){
      //console.log(result);
      html ="" ;

      data=response.result.data;
  for (i=0;i<data.length;i++){
    if(element_type=="" || element_type =="#"){
    html +=image_element(data[i]);
  }else{
    html +=user_element(data[i]);
  }
  }
  if(element_type=="" || element_type=="#"){
  $("#listing").html(html);
}else{
  $("#listingusers").html(html);
}
  next = response.result.next_page_url;
  prev =  response.result.prev_page_url;
  $("#page_index").html("page "+response.result.current_page+" of "+response.result.last_page);

    }});
}
next = "";
prev = "";
    current_page=getPageName(document.location.href);
    console.log(current_page);
    if(current_page=="topusers"){
      getPage(API_URL+"votes",current_page);
    }else{
    getPage(API_URL+"items",current_page);
}
    $( "#next" ).click(function() {
      if (next == null)
          return 0;
      getPage(next,current_page);
    });
    $( "#prev" ).click(function() {
      if (prev == null)
          return 0;
      getPage(prev,current_page);
    });
    ///register
    $("#registerForm").submit(function(event) {

                    /* stop form from submitting normally */
                    event.preventDefault();

                    /* get some values from elements on the page: */
                    var $form = $(this),
                        full_name = $form.find('input[name="full_name"]').val(),
                        password = $form.find('input[name="password"]').val();
                        password_confirmation = $form.find('input[name="password_confirmation"]').val();
                        email = $form.find('input[name="email"]').val();
                        mobile = $form.find('input[name="mobile"]').val();
                    /* Send the data using post */
                    var posting = $.post(API_URL+"users/register", {
                        full_name: full_name,
                        password : password,
                        password_confirmation : password_confirmation,
                        email:email,
                        mobile_number:mobile
                    });

                    posting.done(function(data) {
                      console.log(data);
                        sessionStorage.token = data.result.token;
                        sessionStorage.user_id=data.result.user_id;
                        sessionStorage.full_name=full_name;
                        $(".modal_close").click();
                        $(".loginbtn").css("display","none");
                        $(".registerbtn").css("display","none");
                        $("#welcome").html("Welcome "+full_name);
                    });
                    posting.error(function(data) {
                        alert(data.responseText);
                    });
                });
                //// login
      $("#loginform").submit(function(event) {

                                /* stop form from submitting normally */
                                event.preventDefault();

                                /* get some values from elements on the page: */
                                var $form = $(this),
                                    password = $form.find('input[name="password"]').val();
                                    email = $form.find('input[name="email"]').val();
                                /* Send the data using post */
                                var posting = $.post(API_URL+"users/login", {
                                    password : password,
                                    email:email,
                                });

                                posting.done(function(data) {
                                    console.log(data);
                                      sessionStorage.token = data.result.token;
                                      sessionStorage.user_id=data.result.id;
                                      sessionStorage.full_name=data.result.full_name ;

                                      $(".modal_close").click();
                                      $(".loginbtn").css("display","none");
                                      $(".registerbtn").css("display","none");
                                      $("#welcome").html("Welcome "+data.result.full_name);
                                });
                                posting.error(function(data) {
                                    alert(data.responseText);
                                });
                            });


});
