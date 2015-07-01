<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
    <?php
echo form_open('users/profile');
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Your Account</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
    
    <tr><td width="100">Username</td><td> <?php echo inputan('text', 'username','col-sm-4','Username ..', 1, $r['username'],'');?></td></tr>
    <tr><td>Password</td><td> <?php echo inputan('password', 'password','col-sm-3','Password ..', 1, '','');?></td></tr>
    <tr>
         <td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            
        </td></tr>
</table>
  </div></div>
</FORM>