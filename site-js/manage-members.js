var objects="";

$(document).ready(function(){
	loadMembers();
});

$("#AddMemberButton").on("click",function(){
	$("#AddMemberModal").modal("show");
});

$(document).on("click",".editButton",function(){
	code=$(this).attr("id").replace("editButtonCode","");
	//alert(code);
	for(i=0;i<objects.length;i++)
	{
		if(objects[i].code==code)
		{
			name=objects[i].name;
      institution=objects[i].institution;
			address=objects[i].address;
      gender=objects[i].gender;
      phone=objects[i].phone;
      email=objects[i].email;
      dob= objects[i].dateOfBirth;
      role=objects[i].roleCode;
      department=objects[i].departmentCode;


      //alert(name);
			break;
		}

	}
  $("#EditMemberDepartment").val(department);
  $("#EditMemberRole").val(role);
  $("#EditMemberDOB").val(dob); 
  $("#EditMemberEmail").val(email); 
  $("#EditMemberPhone").val(phone); 
  $("#EditMemberGender").val(gender); 
  $("#EditMemberAddress").val(address); 
  $("#EditMemberInstitution").val(institution); 
	$("#EditMemberName").val(name);	
	$("#EditMemberCode").val(code);
	$("#EditMemberModal").modal("show");
});


$("#EditMemberFormSubmitButton").on("click",function(){
	$("#EditMemberModal").modal("hide");	
	
	var name=$("#EditMemberName").val();
	if(name.trim().length==0)
	{
  	$("#notificationMessage").html("Please provide some input");
  	$("#notificationModal").modal('show');		
	return;
	}
	var code=$("#EditMemberCode").val();
	var email=$("#EditMemberEmail").val();
  if(email.trim().length==0)
  {

    $("#notificationMessage").html("Please provide an Email");
    $("#notificationModal").modal('show');    
  return;
  }
  var phone=$("#EditMemberPhone").val();
  if(phone.trim().length==0)
  {

    $("#notificationMessage").html("Please provide a phone number");
    $("#notificationModal").modal('show');    
  return;
  }
  var dob=$("#EditMemberDOB").val();
  if(dob.trim().length==0)
  {

    $("#notificationMessage").html("Please provide Birth Date");
    $("#notificationModal").modal('show');    
  return;
  }

  var address=$("#EditMemberAddress").val();
  if(address.trim().length==0)
  {

    $("#notificationMessage").html("Please provide an address");
    $("#notificationModal").modal('show');    
  return;
  }
var role=$("#EditMemberRole").val();
  if(role.trim().length==0)
  {

    $("#notificationMessage").html("Please Select a role");
    $("#notificationModal").modal('show');    
  return;
  }
var gender=$("#EditMemberGender").val();
  if(gender.trim().length==0)
  {

    $("#notificationMessage").html("Please select a gender");
    $("#notificationModal").modal('show');    
  return;
  }
  var department=$("#EditMemberDepartment").val();
  if(department.trim().length==0)
  {

    $("#notificationMessage").html("Please select a department");
    $("#notificationModal").modal('show');    
  return;
  }
    var institution=$("#EditMemberInstitution").val();
  if(institution.trim().length==0)
  {

    $("#notificationMessage").html("Please provide institution name");
    $("#notificationModal").modal('show');    
  return;
  }


var urlFormed="UpdateMember.php?name="+encodeURI(name)+"&institution="+encodeURI(institution)+"&email="+encodeURI(email)+"&phone="+encodeURI(phone)+"&dob="+encodeURI(dob)+"&address="+encodeURI(address)+"&role="+encodeURI(role)+"&gender="+encodeURI(gender)+"&department="+encodeURI(department)+"&code="+encodeURI(code);
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
  	$("#membersTableBody").html("");
  	loadMembers();
  }
});

});

$("#AddMemberFormSubmitButton").on("click",function(){
	$("#AddMemberModal").modal("hide");	
	
  var name=$("#AddMemberName").val();
	if(name.trim().length==0)
	{

  	$("#notificationMessage").html("Please provide a name");
  	$("#notificationModal").modal('show');		
	return;
	}
var email=$("#AddMemberEmail").val();
  if(email.trim().length==0)
  {

    $("#notificationMessage").html("Please provide an Email");
    $("#notificationModal").modal('show');    
  return;
  }
  var phone=$("#AddMemberPhone").val();
  if(phone.trim().length==0)
  {

    $("#notificationMessage").html("Please provide a phone number");
    $("#notificationModal").modal('show');    
  return;
  }
  var dob=$("#AddMemberDOB").val();
  if(dob.trim().length==0)
  {

    $("#notificationMessage").html("Please provide Birth Date");
    $("#notificationModal").modal('show');    
  return;
  }

  var address=$("#AddMemberAddress").val();
  if(address.trim().length==0)
  {

    $("#notificationMessage").html("Please provide an address");
    $("#notificationModal").modal('show');    
  return;
  }
var role=$("#AddMemberRole").val();
  if(role.trim().length==0)
  {

    $("#notificationMessage").html("Please Select a role");
    $("#notificationModal").modal('show');    
  return;
  }
var gender=$("#AddMemberGender").val();
  if(gender.trim().length==0)
  {

    $("#notificationMessage").html("Please select a gender");
    $("#notificationModal").modal('show');    
  return;
  }
  var department=$("#AddMemberDepartment").val();
  if(department.trim().length==0)
  {

    $("#notificationMessage").html("Please select a department");
    $("#notificationModal").modal('show');    
  return;
  }
    var institution=$("#AddMemberInstitution").val();
  if(institution.trim().length==0)
  {

    $("#notificationMessage").html("Please provide institution name");
    $("#notificationModal").modal('show');    
  return;
  }
var urlFormed="AddMember.php?name="+encodeURI(name)+"&institution="+encodeURI(institution)+"&email="+encodeURI(email)+"&phone="+encodeURI(phone)+"&dob="+encodeURI(dob)+"&address="+encodeURI(address)+"&role="+encodeURI(role)+"&gender="+encodeURI(gender)+"&department="+encodeURI(department);
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
  	$("#membersTableBody").html("");
  	loadMembers();
  }
});

});



$(document).on("click",".deleteButton",function(){
var code=$(this).attr("id").replace("deleteButtonCode","");
var urlFormed="DeleteMember.php?code="+code;
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
  	$("#membersTableBody").html("");
  	loadMembers();
  }
});
});




function insertRows(objects)
{
var tableRef = document.getElementById('membersTableBody');

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
var newText  = document.createTextNode(object.email);
newCell.appendChild(newText);

var newCell  = newRow.insertCell(3);
var newText  = document.createTextNode(object.phone);
newCell.appendChild(newText);

var newCell  = newRow.insertCell(4);
var newText  = document.createTextNode(object.roleName);
newCell.appendChild(newText);

var newCell  = newRow.insertCell(5);
var newText  = document.createTextNode(object.dateOfBirth);
newCell.appendChild(newText);

var newCell  = newRow.insertCell(6);
var newText  = document.createTextNode(object.gender);
newCell.appendChild(newText);

var newCell  = newRow.insertCell(7);
var newText  = document.createTextNode(object.departmentName);
newCell.appendChild(newText);

var newCell  = newRow.insertCell(8);
var newText  = document.createTextNode(object.address);
newCell.appendChild(newText);

var newCell  = newRow.insertCell(9);
var newText  = document.createTextNode(object.institution);
newCell.appendChild(newText);


var newCell  = newRow.insertCell(10);
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



function loadMembers()
{
var members;

$.ajax(
	{
		url:"GetMembers.php",
		  error : function (jqXHR,textStatus,errorThrown )
  {
   	$("#notificationMessage").html(errorThrown);
  	$("#notificationModal").modal('show'); 
  },
  	success : function(data,textStatus,jqXHR)
  {
  
  	members=$.parseJSON(data);
  	objects=members;
  	insertRows(members);
  } 
	});

}



