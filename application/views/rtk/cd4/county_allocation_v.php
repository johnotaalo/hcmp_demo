<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<div class="coll-md-12">
    <div id="fac-list">
         <?php         
            echo $htm;
         ?>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {
       
    });
</script>
<style type="text/css">
    .facility-list{
        list-style: none;
        font-size: 11px;
        font-family: verdana;

    }
    .facility-list a{

    }

    .facility-list a:active{
        border-left: solid 4px rgb(71, 224, 71);
        background: #EEF1DF;
    }
    .facility-list li{
        border-left: solid 4px darkgreen;
        padding-left: 7px;
        margin-bottom: 1px
    }
    .facility-list ul{
        margin: 0 0 10px 0px;
        border: 1px solid #ccc;
    }
    #fac-list{
        width: 20%;
        margin-top: 1%;        
    }
    #fac-list ul{        
        margin-top: 1%;        
    }

    .facility-list li:hover{
        background: #EEF1DF;
    }
</style>
