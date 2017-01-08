
API_URL = "http://localhost/workshop/";
function is_logged(){
  if(sessionStorage.token){
    return sessionStorage.token;

  }else {
    return false;
  }
}


function approve(id){
  token=is_logged();
  if(token){

    $.ajax({
    url: API_URL+"items/approve",
    type: 'post',
    data: {
      item_id: id,
    },
    headers: {
"token" : token,
        "Authorization": token
    },
    dataType: 'json',
    success: function (data) {
      if(data.result){
        $(".status-"+id).html("Approved");
        $(".status-"+id).addClass('label-success');
        $(".status-"+id).removeClass('label-danger');
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
function disapprove(id){
  token=is_logged();
  if(token ){

    $.ajax({
    url: API_URL+"items/disapprove",
    type: 'post',
    data: {
      item_id: id,

    },
    headers: {
      "token" : token,
        "Authorization": token
    },
    dataType: 'json',
    success: function (data) {
      if(data.result){
        $(".status-"+id).html("Disapproved");
        $(".status-"+id).addClass('label-danger');
        $(".status-"+id).removeClass('label-success');
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
label = item.approve==1 ? "label-success" : "label-danger";
status = item.approve==1 ? "Approved" : "Disapproved";
return  html ='<tr data-status="pagado"><td><div class="ckbox"><a href="javascript:void(0)" onClick="approve('+item.id+')" class="btn btn-info">Approve</a></td>'
+'<td><a href="javascript:void(0)" onClick="disapprove('+item.id+')"  class="btn btn-danger">Disapprove</a></td>'
+'<td><div class="media"><a class="pull-left" href="#"><img class="media-photo" src="'+item.image_url+'">'
+'</a><div class="media-body"><span class="media-meta pull-right">'+item.created_at+'</span>'
+'<h4 class="title">'+item.name+'<span class="status-'+item.id+' pull-right label '+label+'">'+status+'</span><span class="pull-right">likes ('+item.likes+') dislikes ('+item.dislikes+')</span></h4>'
+'<p class="summary">'+item.description+'</p></div></div></td></tr>';
}

$('a[rel*=leanModal]').leanModal({ top: -5, overlay: 1.00,position: "absolute",closeButton: ".modal_close"  });

$(document).ready(function(){/* copy loaded thumbnails into carousel */
//handling session
token=is_logged();
if (token){
if (sessionStorage.is_staff)
{
getPage(API_URL+"admin/items");
}else{

  $("#modaltrigger").click();
}
}else{
  $("#modaltrigger").click();
}




/* listing images  */
function getPage(url){
  token = is_logged();
  if(!token){
    return;
  }
$.ajax({url: url,
  headers: {
      "token" : token,
    "Authorization": token
},
 success: function(response){
      //console.log(result);
      html ="" ;
      data=response.result.data;
  for (i=0;i<data.length;i++){
    html +=image_element(data[i]);
  }
  $("#listing").html(html);
  next = response.result.next_page_url;
  prev =  response.result.prev_page_url;
  $("#page_index").html("page "+response.result.current_page+" of "+response.result.last_page);

    }});
}
next = "";
prev = "";



    $( "#next" ).click(function() {
      if (next == null)
          return 0;
      getPage(next);
    });
    $( "#prev" ).click(function() {
      if (prev == null)
          return 0;
      getPage(prev);
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
                                    if(data.result.is_staff==1){
                                      sessionStorage.token = data.result.token;
                                      sessionStorage.user_id=data.result.id;
                                      sessionStorage.full_name=data.result.full_name ;
                                      sessionStorage.is_staff = data.result.is_staff;
                                      $(".modal_close").click();
                                      getPage(API_URL+"admin/items");
                                    }else{
                                      alert("Unauthorized.")
                                    }
                                });
                                posting.error(function(data) {
                                    alert(data.responseText);
                                });
                            });


});
