<!DOCTYPE html>
<html lang="en" >

<head >

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Avantikeya- Manage Members</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

  
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
    .deleteButton{
        margin-right:5px;
    }

    .form-group
    {
        display: inline-block;
    }
</style>

</head>
<div class="modal fade" id="notificationModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Notification</h4>
        </div>
        <div class="modal-body">
          <p id="notificationMessage"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Avantikeya</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- /.container-fluid -->
    </nav>



<div class="modal fade" id="AddMemberModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Member
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form">
                  <div class="form-group">
                    <label for="AddMemberName">Name</label>
                      <input type="text" class="form-control"
                      id="AddMemberName" />
                  </div>
                  <div class="form-group">
                    <label for="AddMemberEmail">Email</label>
                      <input type="email" class="form-control"
                      id="AddMemberEmail" />
                  </div>
                  <div class="form-group">
                    <label for="AddMemberPhone">Phone Number</label>
                      <input type="text" class="form-control"
                      id="AddMemberPhone" />
                  </div>

                 <div class="form-group">
                    <label for="AddMemberDOB">Date Of Birth</label>
                      <input type="date" class="form-control"
                      id="AddMemberDOB" />
                  </div>

                 <div class="form-group">
                    <label for="AddMemberAddress">Address</label>
                      <input type="text" class="form-control"
                      id="AddMemberAddress" />
                  </div>
                 <div class="form-group">
                    <label for="AddMemberInstitution">Institution</label>
                      <input type="text" class="form-control"
                      id="AddMemberInstitution" />
                  </div>

                    <br/>                  
                  <div class="form-group">
                    <label for="AddMemberRole">Role : </label>
                      <select id="AddMemberRole" >
                    <?php
                    require_once("RoleDAO.php");
                    $roleDAO=new RoleDAO();
                    try
                    {
                    $roles=$roleDAO->getAll();                        
                    foreach ($roles as $role) {
                        echo '<option value="'.$role->code.'">'.$role->name.'</option>';
                    }
                    }
                    catch(Exception $exception)
                    {
                        echo $exception->getMessage();
                    }

                    ?>
                      </select>
                  </div>
                    

                  <div class="form-group">
                    <label for="AddMemberGender">Gender</label>
                    <select id="AddMemberGender">
                    <option value="M">Male </option>
                    <option value="F">Female </option>
                    </select>
                    </div>
                  

                    <br/>
                    <div class="form-group">
                    <label for="AddMemberDepartment">Department : </label>
                      <select id="AddMemberDepartment" >
                    <?php
                    require_once("DepartmentDAO.php");
                    $departmentDAO=new DepartmentDAO();
                    try
                    {
                    $departments=$departmentDAO->getAll();                        
                    foreach ($departments as $department) {
                        echo '<option value="'.$department->code.'">'.$department->name.'</option>';
                    }
                    }
                    catch(Exception $exception)
                    {
                        echo $exception->getMessage();
                    }

                    ?>
                      </select>
                  </div>

                               </form>
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="AddMemberFormSubmitButton">
                    Add Member
                </button>

                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade " id="EditMemberModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit Member
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                    
                <form role="form">
                  <div class="form-group">
                    <label for="EditMemberName">Name</label>
                      <input type="text" class="form-control"
                      id="EditMemberName" placeholder="Enter Title"/>
                  </div>
                  <div class="form-group">
                    <label for="EditMemberEmail">Email</label>
                      <input type="email" class="form-control"
                      id="EditMemberEmail" placeholder="Enter Title"/>
                  </div>
                  <div class="form-group">
                    <label for="EditMemberPhone">Phone Number</label>
                      <input type="text" class="form-control"
                      id="EditMemberPhone" placeholder="Enter Title"/>
                  </div>

                 <div class="form-group">
                    <label for="EditMemberDOB">Date Of Birth</label>
                      <input type="date" class="form-control"
                      id="EditMemberDOB" />
                  </div>

                 <div class="form-group">
                    <label for="EditMemberAddress">Address</label>
                      <input type="text" class="form-control"
                      id="EditMemberAddress" />
                  </div>
                 <div class="form-group">
                    <label for="EditMemberInstitution">Institution</label>
                      <input type="text" class="form-control"
                      id="EditMemberInstitution" />
                  </div>

                    <br/>                  
                  <div class="form-group">
                    <label for="EditMemberRole">Role : </label>
                      <select id="EditMemberRole" >
                    <?php
                    require_once("RoleDAO.php");
                    $roleDAO=new RoleDAO();
                    try
                    {
                    $roles=$roleDAO->getAll();                        
                    foreach ($roles as $role) {
                        echo '<option value="'.$role->code.'">'.$role->name.'</option>';
                    }
                    }
                    catch(Exception $exception)
                    {
                        echo $exception->getMessage();
                    }

                    ?>
                      </select>
                  </div>
                    

                  <div class="form-group">
                    <label for="EditMemberGender">Gender</label>
                    <select id="EditMemberGender">
                    <option value="M">Male </option>
                    <option value="F">Female </option>
                    </select>
                    </div>
                  

                    <br/>
                    <div class="form-group">
                    <label for="EditMemberDepartment">Department : </label>
                      <select id="EditMemberDepartment" >
                    <?php
                    require_once("DepartmentDAO.php");
                    $departmentDAO=new DepartmentDAO();
                    try
                    {
                    $departments=$departmentDAO->getAll();                        
                    foreach ($departments as $department) {
                        echo '<option value="'.$department->code.'">'.$department->name.'</option>';
                    }
                    }
                    catch(Exception $exception)
                    {
                        echo $exception->getMessage();
                    }

                    ?>
                      </select>
                  </div>

                 <div class="form-group">
                      <input type="hidden" class="form-control"
                      id="EditMemberCode" />
                  </div>
               
                </form>
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="EditMemberFormSubmitButton">
                    Update Member
                </button>

                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>


    <!-- Portfolio Grid Section -->
   
    <section id="portfolio" class="portfolio" style="margin-top:70px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Manage Members</h2>
                   </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
            <button class="btn btn-md btn-success" id="AddMemberButton">Add Member</button>
                    <br><br/>
                    
                    <table class="table table-bordered">
                <thead>
                    <tr>
                    <td>S.No.</td>
                    <td>Member Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Role</td>
                    <td>D.O.B</td>
                    <td>Gender</td>
                    <td>Department</td>
                    <td>Address</td>
                    <td>Institution
                    <td>Options</td>

                    </tr>
                </thead>
                <tbody id="membersTableBody">

                </tbody>
                </table>
                </div> 
            </div>
         </div>
    </section>


    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>


      
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
 <script src="site-js/manage-members.js" type="text/javascript"></script>
 
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
