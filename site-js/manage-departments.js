var objects="";

$(document).ready(function(){
	loadDepartments();
});

$("#AddDepartmentButton").on("click",function(){
	$("#AddDepartmentModal").modal("show");
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
	$("#EditDepartmentName").val(name);	
	$("#EditDepartmentCode").val(code);
	$("#EditDepartmentModal").modal("show");
});


$("#EditDepartmentFormSubmitButton").on("click",function(){
	$("#EditDepartmentModal").modal("hide");	
	
	var name=$("#EditDepartmentName").val();
	if(name.trim().length==0)
	{
  	$("#notificationMessage").html("Please provide some input");
  	$("#notificationModal").modal('show');		
	return;
	}
	var code=$("#EditDepartmentCode").val();
	
var urlFormed="UpdateDepartment.php?name="+encodeURI(name)+"&code="+code;
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
  	$("#departmentsTableBody").html("");
  	loadDepartments();
  }
});

});

$("#AddDepartmentFormSubmitButton").on("click",function(){
	$("#AddDepartmentModal").modal("hide");	
	var name=$("#DepartmentName").val();
	if(name.trim().length==0)
	{

  	$("#notificationMessage").html("Please provide some input");
  	$("#notificationModal").modal('show');		
	return;
	}
var urlFormed="AddDepartment.php?name="+encodeURI(name);
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
  	$("#departmentsTableBody").html("");
  	loadDepartments();
  }
});

});



$(document).on("click",".deleteButton",function(){
var code=$(this).attr("id").replace("deleteButtonCode","");
var urlFormed="DeleteDepartment.php?code="+code;
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
  	$("#departmentsTableBody").html("");
  	loadDepartments();
  }
});
});




function insertRows(objects)
{

var tableRef = document.getElementById('departmentsTableBody');

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
}



function loadDepartments()
{
var departments;

$.ajax(
	{
		url:"GetDepartments.php",
		  error : function (jqXHR,textStatus,errorThrown )
  {
   	$("#notificationMessage").html(errorThrown);
  	$("#notificationModal").modal('show'); 
  },
  	success : function(data,textStatus,jqXHR)
  {
  
  	departments=$.parseJSON(data);
  	objects=departments;
  	insertRows(departments);
  } 
	});

}



