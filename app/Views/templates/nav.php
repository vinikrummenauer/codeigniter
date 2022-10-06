<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="./public/assets/templates/images/cifrao.png" style="width:3rem" class="d-inline-block align-text-top"/>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo base_url() ?>/">Home</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="<?php echo base_url() ?>/moviments">Moviment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>/reports">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?php echo base_url()?>/users" >Users</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="<?php echo base_url() ?>/login/signOut" title="<?php //echo $_SESSION['user']['name'] ?>">
            <i class="bi-person" style="color:#F00"></i>
        </a>
        
      </span>
    </div>
  </div>
</nav>