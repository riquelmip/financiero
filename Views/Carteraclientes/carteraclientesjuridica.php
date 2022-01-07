<?php 
    headerAdmin($data); 
    getModal('modalCliente',$data);
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-user-o"></i> <?= $data['page_title'] ?>
              <?php if (!empty($_SESSION['permisosMod']['escribir'])) { ?>
                <button class="btn btn-success" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Ingresar nuevo cliente</button>
              <?php } ?>
            </h1>
        </div>
      </div>

        <div class="row">
            <div class="col-md-12">
            <div class="tab" role="tabpanel">
            <ul class="nav nav-tabs " role="tablist">
                    <li role="presentation" class="active"><a href="#javatab" aria-controls="home" role="tab" data-toggle="tab">Cliente A</a></li>
                    <li role="presentation"><a href="#jquerytab" aria-controls="profile" role="tab" data-toggle="tab">Cliente B</a></li>
                    <li role="presentation"><a href="#ctab" aria-controls="messages" role="tab" data-toggle="tab">Cliente C</a></li>
                    <li role="presentation"><a href="#mysqltab" aria-controls="settings" role="tab" data-toggle="tab">Cliente D</a></li>
                </ul>
                </div>
              <div class="tile">
                <div class="tile-body">
                <div class="btn-group mb-2" role="group" aria-label="Basic example">
            <button type="button" onclick="persona_natural()" class="btn btn-success">Persona Natural</button>
            <button type="button" onclick="persona_juridica()" class="btn btn-warning">Persona Jurídica</button>
          </div>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableClientes">
                      <thead>
                        <tr>
                          <th>Código Persona Juridica</th>
                          <th>Nombre de la Empresa</th>
                          <th>Dirección</th>
                          <th>Teléfono</th>
                          <th>Balance General</th>
                          <th>Estado de Resultado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
  
  <!--      <!DOCTYPE html>
<html>
<head>




</head>

<body>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="tab" role="tabpanel">
                 Nav tabs
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#javatab" aria-controls="home" role="tab" data-toggle="tab">Java</a></li>
                    <li role="presentation"><a href="#jquerytab" aria-controls="profile" role="tab" data-toggle="tab">jQuery</a></li>
                    <li role="presentation"><a href="#ctab" aria-controls="messages" role="tab" data-toggle="tab">C#</a></li>
                    <li role="presentation"><a href="#mysqltab" aria-controls="settings" role="tab" data-toggle="tab">MySQL Tutorial</a></li>
                </ul>
             Tab panes content goes here
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="javatab">
                        <h4>Java</h4>
                            <p>
                                The Java is an object-oriented programming language that was developed by James Gosling from the Sun Microsystems in 1995.
                                The Java is an object-oriented programming language that was developed by James Gosling from the Sun Microsystems in 1995.<br /><br />
                                The Java is an object-oriented programming language that was developed by James Gosling from the Sun Microsystems in 1995.
                                The Java is an object-oriented programming language that was developed by James Gosling from the Sun Microsystems in 1995.<br /><br />
                                <ul>
                                <li>Chapter 1</li>
                                <li>Chapter 2</li>
                                <li>Chapter 3</li>
                                <li>Chapter 4</li>
                            </ul>                                                        
                            </p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="jquerytab">
                        <h4>jQuery</h4>
                        <p>
                            jQuery content here
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ctab">
                        <h4>C#</h4>
                        <p>
                           C# is also a programming language
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="mysqltab">
                        <h4>MySQL</h4>
                        <p>
                            MySQL is a databased mostly used for web applications.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>-->         
<?php footerAdmin($data); ?>
    