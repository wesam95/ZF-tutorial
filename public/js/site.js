  $(document).ready(function(){
  	$('body').on('click','#add',function(){
  		$("form[name=insert]").validate();
    });
      $("#submitbutton").click(function(){
      $("form[name=insert]").submit();
    });
      $("form[name=insert]").on('submit',function(){
        $.ajax({url:"/index/add",
                dataType:'json',
                success:function(data){
                  console.log(data);
          $(".albums").append('<tr id="'+data['id']+'">'
          +'<td class= "title">'+data['title']+'</td>'
          +'<td class= "artist">'+data['artist']+'</td>'
          +'<td><a id= "edit">Edit</a> <a id= "delete">delete</a></td></tr>');
          $("#insertForm").hide();
          $("form[name=insert]").clearForm();
          }
      });
    });  
  

    $('body').on('click','#edit',function(){
      var id = $(this).parent().parent().attr('id');
  		$("#editForm").removeClass("hidden");
  		$("#insertForm").addClass("hidden");
      $.ajax({url: "/index/edit/?id="+id+"",
        dataType: "json",
        success:function(data){
          $("input[name=title]").val(data['title']);
          $("input[name=artist]").val(data['artist']);
          $("input[name=id]").val(data['id']);
          }
        });
      });
  	  $("form[name=edit]").validate();
      $("form[name=edit]").ajaxForm(function(data){
      var row= $(".albums").find("#"+data['id']+"");
      row.find(".title").text(data['title']);
      row.find(".artist").text(data['artist']);
      $("#editForm").addClass("hidden");
      });
  });