var objects="";

$(document).ready(function(){
	loadRoles();
});

$("#AddRoleButton").on("click",function(){
	$("#AddRoleModal").modal("show");
});

$(document).on("click",".editButton",function(){
	code=$(this).attr("id").replace("editButtonCode","");
	//alert(code);
	for(i=0;i<objects.length;i++)
	{
		if(objects[i].code==code)
		{
			name=objects[i].name;
			//alert(name);
			break;
		}
	}
	$("#EditRoleName").val(name);	
	$("#EditRoleCode").val(code);
	$("#EditRoleModal").modal("show");
});


$("#EditRoleFormSubmitButton").on("click",function(){
	$("#EditRoleModal").modal("hide");	
	
	var name=$("#EditRoleName").val();
	if(name.trim().length==0)
	{
  	$("#notificationMessage").html("Please provide some input");
  	$("#notificationModal").modal('show');		
	return;
	}
	var code=$("#EditRoleCode").val();
	
var urlFormed="UpdateRole.php?name="+encodeURI(name)+"&code="+code;
$.ajax({

  url: urlFormed,
  error : function (jqXHR,textStatus,errorThrown )
  {
  	$("#notificationMessage").html(errorThrown);
  	$("#notificationModal").modal('show');
  },success : function(data,textStatus,jqXHR)
  {
  	$("#notificationMessage").html(data);
  	$("#notificationModal").modal('show');
  	$("#rolesTableBody").html("");
  	loadRoles();
  }
});

});

$("#AddRoleFormSubmitButton").on("click",function(){
	$("#AddRoleModal").modal("hide");	
	var name=$("#RoleName").val();
	if(name.trim().length==0)
	{

  	$("#notificationMessage").html("Please provide some input");
  	$("#notificationModal").modal('show');		
	return;
	}
var urlFormed="AddRole.php?name="+encodeURI(name);
$.ajax({

  url: urlFormed,
  error : function (jqXHR,textStatus,errorThrown )
  {
  	$("#notificationMessage").html(errorThrown);
  	$("#notificationModal").modal('show');
  },success : function(data,textStatus,jqXHR)
  {
  	$("#notificationMessage").html(data);
  	$("#notificationModal").modal('show');
  	$("#rolesTableBody").html("");
  	loadRoles();
  }
});

});

$(document).on("click",".deleteButton",function(){
   
var code=$(this).attr("id").replace("deleteButtonCode","");

var urlFormed="DeleteRole.php?code="+code;
$.ajax({

  url: urlFormed,
  error : function (jqXHR,textStatus,errorThrown )
  {
  	$("#notificationMessage").html(errorThrown);
  	$("#notificationModal").modal('show');
  },success : function(data,textStatus,jqXHR)
  {
  	$("#notificationMessage").html(data);
  	$("#notificationModal").modal('show');
  	$("#rolesTableBody").html("");
  	loadRoles();
  }
});});

function insertRows(objects)
{

var tableRef = document.getElementById('rolesTableBody');

var x=0;
while(x<objects.length)
{
object = objects[x];	
// Insert a row in the table at the last row
var newRow   = tableRef.insertRow(tableRef.rows.length);

// Insert a cell in the row at index 0
var newCell  = newRow.insertCell(0);
var newText  = document.createTextNode(""+(x+1));
newCell.appendChild(newText);
var newCell  = newRow.insertCell(1);
var newText  = document.createTextNode(object.name);
newCell.appendChild(newText);
var newCell  = newRow.insertCell(2);
//deleteButton
var a = document.createElement('a');
var linkText = document.createTextNode("Delete");
a.appendChild(linkText);
a.className ="btn btn-warning btn-sm deleteButton";
a.id = "deleteButtonCode"+object.code;
newCell.appendChild(a);


//editButton
var a = document.createElement('a');
var linkText = document.createTextNode("Edit");
a.appendChild(linkText);
a.className ="btn btn-warning btn-sm editButton";
a.id = "editButtonCode"+object.code;

newCell.appendChild(a);

x++;
}


/*           
str+= "<a class='btn btn-warning btn-sm deleteButton' code='"+object.code+"'>Delete</a>&nbsp;";
str+= "<a class='btn btn-warning btn-sm editButton' code='"+object.code+"'>Edit</a>";
*/
}



function loadRoles()
{
var roles;

$.ajax(
	{
		url:"GetRoles.php",
		  error : function (jqXHR,textStatus,errorThrown )
  {
   	$("#notificationMessage").html(errorThrown);
  	$("#notificationModal").modal('show'); 
  },
  	success : function(data,textStatus,jqXHR)
  {
  
  	roles=$.parseJSON(data);
  	objects=roles;
  	insertRows(roles);
  } 
	});
/*
	
*/


}



