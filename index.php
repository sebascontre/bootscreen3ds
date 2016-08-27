<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Open+Sans:400,600" />
    <link rel="stylesheet" href="//cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css" />
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
    
    <style type="text/css">
        h1 { font-family: 'Open Sans Condensed', sans-serif; font-weight: 300; text-align: center; font-size: 48px; }
        span { font-family: 'Open Sans', sans-serif; font-weight: 600; display: block; font-size: 16px; text-align: center; margin-top: -12px; margin-bottom: 40px; }
        span.credit { margin-top: -36px; font-size: 12px; }
        .container { width: 830px; margin: 32px auto 16px; }
        .select-inline { width: auto; display: inline-block; }
        .form-control-sm { padding: .1rem .2rem; font-weight: 600; }
        label[for] { font-weight: 600; }
        img#preview { margin: 0 auto; }
        
        .col-xs-10 .radio { width: 20%; height: 80px; display: inline-block;
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
    float: left;
            
        }
        
        .col-xs-10 .radio * { vertical-align: center; }
    </style>
    
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            
            var $IMG = $("#preview");
            
            $("#settings input, #settings select").on('change', function() {
                
                $form = $("#settings");
                
                var url = "images/generator.php?v=4";
                
                url += "&model=" + $('input[name=model]:checked', "#settings").val();
                url += "&type=" + $('select[name=type] option:selected', "#settings").val();
                url += "&region=" + $('select[name=region] option:selected', "#settings").val();
                url += "&sd=" + $('select[name=sd] option:selected', "#settings").val();
                
                if ($('input[name=hold]', "#settings").is(':checked'))
                    url += "&onboot=" + $('select[name=onboot] option:selected', "#settings").val();
                else
                    url += "&onboot=false";
                    
                if ($('input[name=secondLine]', "#settings").is(':checked'))
                    url += "&secondLine=true&secondButton="+ $form.find('select[name=secondButton] option:selected').val() +"&secondTool="+ $form.find('select[name=secondTool] option:selected').val();
                
                $IMG.attr('src', url);
            });
            
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Old School PC BIOS</h1>
        <span>Splash Bootscreen Generator <small>v4.1.1</small></span>
        <span class="credit">made with &#10084; by <a href="https://twitter.com/sebascontre">@sebascontre</a></span>

        <form id="settings">
            <div class="row">
                <fieldset class="form-group col-xs-10">
                    <label for="model">Nintendo 3DS Model</label><br/>
                    <div class="radio">
                        <label><input type="radio" name="model" value="3ds" checked> <img class="console" src="images/consoles/3ds.png" /></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="model" value="3dsxl"> <img class="console" src="images/consoles/3dsxl.png" /></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="model" value="2ds"> <img class="console" src="images/consoles/2ds.png" /></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="model" value="new3ds"> <img class="console" src="images/consoles/new3ds.png" /></label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="model" value="new3dsxl"> <img class="console" src="images/consoles/new3dsxl.png" /></label>
                    </div>
                </fieldset>
                <fieldset class="form-group col-xs-2">
                    <label for="region">Region</label>
                    <select name="region" class="form-control">
                        <option value="usa" selected="selected">USA</option>
                        <option value="eur">EUR</option>
                        <option value="jpn">JPN</option>
                    </select>
                    <br/>
                    <label for="sd">SD Card</label>
                    <select name="sd" class="form-control">
                        <option value="2g" selected="selected">2GB</option>
                        <option value="4g">4GB</option>
                        <option value="8g">8GB</option>
                        <option value="16g">16GB</option>
                        <option value="32g">32GB</option>
                        <option value="64g">64GB</option>
                        <option value="128g">128GB</option>
                    </select></fieldset>
            </div>


        <fieldset class="form-group col-xs-7">
            <label for="something">Other Options</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="hold"> <strong>Hold</strong>
                    <select name="onboot" class="form-control form-control-sm select-inline">
                        <option value="L" selected="selected">L</option>
                        <option value="R">R</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="X">X</option>
                        <option value="Y">Y</option>
                        <option value="UP">UP</option>
                        <option value="DOWN">DOWN</option>
                        <option value="LEFT">LEFT</option>
                        <option value="RIGHT">RIGHT</option>
                        <option value="START">START</option>
                        <option value="SELECT">SELECT</option>
                    </select> <strong>on boot</strong> to boot to <strong>SysNAND</strong>.
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="secondLine"> <strong>Hold</strong>
                    <select name="secondButton" class="form-control form-control-sm select-inline">
                        <option value="L" selected="selected">L</option>
                        <option value="R">R</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="X">X</option>
                        <option value="Y">Y</option>
                        <option value="UP">UP</option>
                        <option value="DOWN">DOWN</option>
                        <option value="LEFT">LEFT</option>
                        <option value="RIGHT">RIGHT</option>
                        <option value="START">START</option>
                        <option value="SELECT">SELECT</option>
                    </select> <strong>now</strong> to enter to 
                    <select name="secondTool" class="form-control form-control-sm select-inline">
                        <option value="rxtools" selected="selected">Rxtools settings</option>
                        <option value="bootmanager">Boot Manager</option>
                        <option value="gateway">Gateway Menu</option>
                        <option value="settings">Settings</option>
                    </select>.
                </label>
            </div>
            
            <label for="type">Type</label>
            <select name="type" class="form-control">
                <option value="luma_611" selected="selected">Luma3DS v6.1.1</option>
                <option value="luma_61">Luma3DS v6.1</option>
                <option value="luma_601">Luma3DS v6.0.1</option>
                <option value="luma_60">Luma3DS v6.0</option>
                <option value="luma">Luma3DS</option>
                <option value="menuhax_31">Menuhax v3.1</option>
                <option value="menuhax_30">Menuhax v3.0</option>
                <option value="menuhax_22">Menuhax v2.2</option>
                <option value="menuhax_21">Menuhax v2.1</option>
            </select></fieldset>
        </fieldset>
    </form>
    
    <br/><center>
    <img id="preview" src="images/generator.php?v=4&model=3ds&type=luma_61&region=usa&sd=2g&onboot=false" /></center>
    

    <br/><br/>
    <center><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 3D -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-8039083170373087"
     data-ad-slot="3412912701"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<br/>
<script id="_wauaux">var _wau = _wau || []; _wau.push(["small", "4wlmvp1mr28d", "aux"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/small.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script>
</center>
    
    </div>
</body>
</html>