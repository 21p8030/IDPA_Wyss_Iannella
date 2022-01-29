<?php
/* Smarty version 3.1.39, created on 2022-01-27 15:00:16
  from '/var/www/html/src/views/navbar.smarty' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f2a5707280c3_13526944',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f678256bf8be4ac704ec0d694193754c43a3b04' => 
    array (
      0 => '/var/www/html/src/views/navbar.smarty',
      1 => 1643290213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f2a5707280c3_13526944 (Smarty_Internal_Template $_smarty_tpl) {
?><nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" style="<?php if (!(isset($_SESSION['username'])) && empty($_SESSION['username'])) {?>background-color: red;<?php }?>" href="/">Schulforum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="/">Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/categories">Kategorien
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/tags">Tags
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/allThreads">Alle Beiträge
          </a>
        </li>
        <?php if ((isset($_SESSION['username'])) && !empty($_SESSION['username'])) {?>
          <li class="nav-item">
            <a class="nav-link" href="/createThread">Frage stellen
            </a>
          </li>
        <?php }?>
      </ul>
      <ul class="navbar-nav">
        <?php if ((isset($_SESSION['username'])) && !empty($_SESSION['username'])) {?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Benutzer</a>
            <div class="dropdown-menu" style="right: 0px; left: unset;">
              <a class="dropdown-item" href="/myThreads">Meine Beiträge</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/logout">Logout</a>
            </div>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
        <?php }?>
      </ul>
    </div>
  </div>
</nav><?php }
}
