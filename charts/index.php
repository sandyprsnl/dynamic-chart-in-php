<?php
require_once "header.php";
?>
<div class="container">
    <h1>which os populer language in 2020 ?</h1>
    <form>
        <div class="form-check">
            <input class="form-check-input programing_lang" name="programing_lang" type="radio" value="php" id="programing_lang1" checked>
            <label class="form-check-label" for="defaultCheck1">
                PHP
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input programing_lang" name="programing_lang" type="radio" value="node.js" id="programing_lang2">
            <label class="form-check-label" for="defaultCheck1">
                node.js
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input programing_lang" name="programing_lang" type="radio" value="python" id="programing_lang3">
            <label class="form-check-label" for="defaultCheck1">
                python
            </label>
        </div>
        <button type="submit" class="btn btn-primary" id="submit-data">Submit</button>
    </form>

</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">PIE chart</h5>
                    <div class="chart-container pie_chart">
                        <canvas id="pie_chart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4"></div>
    </div>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#submit-data').on('click', function(e) {
            e.preventDefault();
            var language = $('input[name=programing_lang]:checked').val();
            $.ajax({
                url: 'data.php',
                method: 'POST',
                data: {
                    action: 'insert',
                    lang: language,
                    beforeSend: function() {
                        $('#submit-data').attr('disabled', true);

                    },
                    success: function(data) {
                        $('#submit-data').attr('disabled', false);
                        $('.programing_lang1').attr('checked', false);
                        $('#programing_lang1').attr('checked', true);
                        makechart();
                        alert('your feedback has  been send');
                        

                    }
                }
            });
        })
        
    makechart();
    });
    function makechart(){
        $.ajax({
                url: 'data.php',
                method: 'POST',
                data:{
                    action:'fetch', 
                },
                dataType:'JSON',
                success:function(data){
                    var language=[];
                    var total=[];
                    var color=[];
                    for(var count=0;count<data.length;count++){
                        language.push(data[count].language);
                        total.push(data[count].total);
                        color.push(data[count].color);

                    }
                    
                var chart_data={
                    labels:language,
                    datasets:[
                        {
                            label:'vote',
                            backgroundColor:color,
                            color:'#fff',
                            data:total,
                        }
                    ],
                }
                var options={
                    responsive:true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    // scales:{
                    //     yAxes:[{
                    //         ticks:{
                    //             min:0
                    //         }
                    //     }]
                    }
                }
                var group_chart1=$('#pie_chart');
                group_chart1.html('');
                var graph1=new Chart(group_chart1,{
                    type:'pie',
                    data: chart_data,
                    options:options
                });

                }

        });
    }
</script>


</body>

</html>