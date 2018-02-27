  $(document).ready(function(){
  	$('body').on('click','#add',function(){
  		$("form[name=insert]").validate();
    });

      $("#submitbuttonAdd").click(function(){
        $("form[name=insert]").submit();
      });
      $("form[name=insert]").ajaxForm(function(data){
          $(".albums").append(data);
          $("form[name=insert]").clearForm();
          });
      
      
  

    $('body').on('click','#edit',function(){
      var id = $(this).parent().parent().attr('id');
      $.ajax({url: "/index/edit/?id="+id+"",
        dataType: "json",
        success:function(data){
          $("form[name=edit]").find("input[name=title]").val(data['title']);
          $("form[name=edit]").find("input[name=artist]").val(data['artist']);
          $("form[name=edit]").find("input[name=id]").val(data['id']);
          }
        });
      });
  	  $("form[name=edit]").validate();

      $("#submitbuttonEdit").click(function(){
      $("form[name=edit]").submit();
    });
      $("form[name=edit]").ajaxForm(function(data){
      var row= $(".albums").find("#"+data['id']+"");
      row.find(".title").text(data['title']);
      row.find(".artist").text(data['artist']);
      });

      $('body').on('click','#delete',function(){
        var id = $(this).parent().parent().attr('id');
        $.ajax({url:"/index/delete/?id="+id+"",
          dataType: "json",
          success:function(data){
            $("p[id=warning]").text("Are you sure that you want to delete '"+data['title']+"' by '"+data['artist']+"'");
            $("input[type=hidden][name=id]").val(data['id']);
          }
        });
      });

      $("#submitbuttonDelete").click(function(){
      $("form[name=delete]").submit();
      });
      $("form[name=delete]").ajaxForm(function(data){
      var row= $(".albums").find("#"+data['id']+"");
      $(row).remove();        
      });
  });