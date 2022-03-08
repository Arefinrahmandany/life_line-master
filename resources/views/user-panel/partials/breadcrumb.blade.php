<div class="row breadcrumb_textr">
  <div class="col-md-6 col-sm-6"style="height: 50px;">
    <h3 class="page-title ms_x_cardTitle_s"style="width:fit-content;">
      @yield('breadcrumb-page-title')
    </h3>
  </div>
  <div class="col-md-6 col-sm-6"style="height: 50px;">
    <h3 aria-label="breadcrumb" role="navigation" class="breadcrumbdd"style="width:fit-content;float:right;">
      <ol class="breadcrumb breadcrumb-custom ms_x_cardTitle_s">
        @yield('breadcrumb')
      </ol>
    </h3>
  </div>
</div>
<style media="screen">
.breadcrumb.breadcrumb-custom .breadcrumb-item {
  font-size: 0.875rem;
  background: #dbe3e6;
  padding:4.6px 10px;
}
.breadcrumb{border: none;}
@media (max-width: 576px)
{
.breadcrumbdd {
  float: left!important;
}
.breadcrumb_textr h3,.breadcrumb_textr a{
  font-size: 12px;
}
}
</style>
