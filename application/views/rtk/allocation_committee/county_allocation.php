<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url(); ?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">

    @import "<?php echo base_url(); ?>DataTables-1.9.3/media/css/jquery.dataTables.css";

</style>   

<a href="national_rtk_allocations.php"></a>
<script type="text/javascript" charset="utf-8">
    $(function() {

        $('#switch-category').click(function() {
            $('#allocations_form')[0].reset();
        });

        $('#c_div').hide();
        $('#dis_div').hide();
        $('#facil_div').hide();
        $('#zone_div').hide();


        $('#filter_sub').hide();
        $('#sub-filter-by').hide();

        var json_counties = '<?php echo $counties; ?>';
        var counties = JSON.parse(json_counties);


        var json_facilities = '<?php echo $facilities; ?>';
        var facilities = JSON.parse(json_facilities);

        var json_subcounties = '<?php echo $districts; ?>';
        var subcounties = JSON.parse(json_subcounties);

        $('#switch_counties').change(function() {
            var county = $("#switch_counties").val();
            var options = '<option value="">*Select a Sub-County*</option>';

            for (i = 0; i < subcounties.length; ++i) {
                if (subcounties[i]["county"] == county) {
                    options += '<option value="' + subcounties[i]["id"] + '">' + subcounties[i]["district"] + '</option>';
                }
            }

            $("#switch_districts").html(options);

            if (!$("#switch_counties").val()) {
                $("#dis_div").hide();
            } else {
                $("#dis_div").show();
            }

        });
        $('#switch_districts').change(function() {
            var subcounty = $("#switch_districts").val();
            var options = '<option value="">*Select a Facility*</option>';
            for (i = 0; i < facilities.length; ++i) {
                if (facilities[i]["district"] == subcounty) {
                    options += '<option value="' + facilities[i]["id"] + '">' + facilities[i]["facility_name"] + '</option>';
                }
            }

            $("#switch_facilities").html(options);

            if (!$("#switch_districts").val()) {
                $("#facil_div").hide();
            } else {
                $("#facil_div").show();
            }

        });

        $('#date_from').datepicker();
        $('#date_to').datepicker();


        $('#filter').click(function() {
            var county = $('#switch_counties option:selected').attr('id');
            var district = $('#switch_districts option:selected').attr('id');
            var facility = $('#switch_facilities option:selected').attr('id');
            var zone = $('#switch_zones option:selected').attr('id');
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
        });
        $('#switch-category').change(function() {
            $('#filter_sub').removeAttr('hidden');
            var category = $(this).find('option:selected').attr('id');
            if (category == 0) {
                $('#c_div').hide();
                $('#dis_div').hide();
                $('#facil_div').hide();
                $('#zone_div').hide();
                $('#filter_main').show();
                $('#filter_sub').hide();
                $('#sub-filter-by').hide();

            } else if (category == 1) {
                $('#c_div').hide();
                $('#dis_div').hide();
                $('#facil_div').hide();
                $('#zone_div').hide();
                $('#filter_main').show();
                $('#filter_sub').hide();
                $('#sub-filter-by').hide();
            } else if (category == 2) {
                $('#dis_div').hide();
                $('#facil_div').hide();
                $('#zone_div').hide();
                var options = '<option value="">*Select a County*</option>';
                for (i = 0; i < counties.length; ++i) {
                    options += '<option value="' + counties[i]["id"] + '">' + counties[i]["county"] + '</option>';
                }

                $("#switch_counties").html(options);
                $('#c_div').show();
                $('#filter_sub').show();
                $('#filter_main').hide();
                $('#sub-filter-by').show();

            } else if (category == 3) {
                var options = '<option value="">*Select a Sub-County*</option>';
                for (i = 0; i < subcounties.length; ++i) {
                    options += '<option value="' + subcounties[i]["id"] + '">' + subcounties[i]["district"] + '</option>';
                }
                $("#switch_districts").html(options);
                $('#dis_div').show();
                $('#c_div').hide();
                $('#facil_div').hide();
                $('#zone_div').hide();
                $('#filter_sub').show();
                $('#filter_main').hide();
                $('#sub-filter-by').show();

            } else if (category == 4) {
                var options = '<option value="">*Select a Facility*</option>';
                for (i = 0; i < facilities.length; ++i) {
                    options += '<option value="' + facilities[i]["id"] + '">' + facilities[i]["facility_name"] + '</option>';
                }
                $("#switch_facilities").html(options);
                $('#facil_div').show();
                $('#c_div').hide();
                $('#dis_div').hide();
                $('#zone_div').hide();
                $('#filter_sub').show();
                $('#filter_main').hide();
                $('#sub-filter-by').show();


            } else if (category == 5) {
                $('#zone_div').show();
                $('#c_div').hide();
                $('#dis_div').hide();
                $('#facil_div').hide();
                $('#filter_sub').show();
                $('#filter_main').hide();
                $('#sub-filter-by').show();

            }
        });

        $('.filter_btn').click(function() {
            var allocations_form = $('#allocations_form').serialize();
            var switch_category = $('#switch-category').val();
            var switch_zones = $('#switch_zones').val();
            var switch_facilities = $('#switch_facilities').val();
            var switch_districts = $('#switch_districts').val();
            var switch_counties = $('#switch_counties').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();

            $.post("<?php echo base_url() . 'rtk_management/getallocations'; ?>", {
                allocations_form: allocations_form,
                switch_category: switch_category,
                switch_zones: switch_zones,
                switch_facilities: switch_facilities,
                switch_districts: switch_districts,
                switch_counties: switch_counties,
                date_from: date_from,
                date_to: date_to
            }).done(function(data) {
                alert("Data Loaded: " + data);
//    window.location = "<?php echo base_url() . 'rtk_management/allocations_county_view'; ?>";
            });

        });


    });
</script>
<style type="text/css">
    #main-filter-by{
        width: 100%;
        height: auto;
        font-size: 180%;
        border-bottom: 1px solid #ccc;
    }
    #sub-filter-by{
        width: 100%;  
        height: auto;
        padding-top: 5px; 
        border-bottom: 1px solid #ccc; 
        float: left;
        font-size: 120%;
    }
    .select{
        margin-left: 10px;
        width: auto;
        float: left;
    }  
</style>


<div id="inner_wrapper">   
    <div class="dash_main" style="width: 80%;float: right;">
        <form id="allocations_form" name="allocations_form" >
            <div id="main-filter-by">
                Criteria: 
                <select  id="switch-category">
                    <option id="0">Select Category</option>
                    <option id="1">National</option>
                    <option id="2">County</option>
                    <option id="3">Sub-County</option>
                    <option id="4">Facility</option>
                    <option id="5">Zone</option>
                </select>
                From:<input type="text" name="date_from" id="date_from" data-provide="datepicker"/ > 
                            To: <input type="text" name="date_to" id="date_to"/>
                <button id="filter_main" class="btn filter_btn">Filter</button>   
            </div>
            <div id="sub-filter-by">
                <div id="c_div" class="select">
                    Select County: 
                    <select name="switch_counties" id="switch_counties"></select>
                </div>    
                <div id="dis_div" class="select">
                    Select Sub-County: 
                    <select name="switch_districts" id="switch_districts"></select>
                </div>
                <div id="facil_div" class="select">
                    Select Facility: 
                    <select id="switch_facilities"></select>
                </div>
                <div id="zone_div" class="select">
                    Select Zone:  
                    <select name="switch_zones" id="switch_zones">
                        <option id="">Select Zone</option>
                        <option id="a">A</option>
                        <option id="b">B</option>
                        <option id="c">C</option>
                        <option id="d">D</option>
                    </select>
                </div>
                <a id="filter_sub" class="btn filter_btn">Filter</a>
            </div>
        </form>
        <table id="allocated" class="data-table"> 

        </table></div>
</div>