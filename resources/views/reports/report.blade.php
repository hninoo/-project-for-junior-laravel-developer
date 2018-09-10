@extends('layouts.admin')
@section('admin_view')
<?php
function color_define($text)
{
  if($text=='absent')
  {
    echo '<span style="color:red;">'.$text.'</span>';
  }
  elseif ($text=='leave')
  {
    echo '<span style="color:brown;">'.$text.'</span>';
  }
  else
  {
    echo '<span style="color:black;">'.$text.'</span>';
  }
}
 $sum = strtotime('00:00:00');
 $sum2=0;
 ?>


<script src="{{ asset('excelExport/html2canvas.js') }}"></script>
<script src="{{ asset('excelExport/jquery.base64.js') }}"></script>
<script src="{{ asset('excelExport/tableExport.js') }}"></script>

<div class="table-responsive">
 <table class="table" id="excel_table">

  <thead>
    <tr>
      <th>Name</th>
      <?php
        $month = date("m");
        $year = date("Y");


        $tDays  = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        for($i=1; $i<=$tDays;$i++)
        {
          if($i<10)
          { $dates[] = date("Y-m")."-0".$i; }
          else
          { $dates[] = date("Y-m")."-".$i; }
        }
        //_____________
        foreach($dates as $d)
        {
      ?>
        <th><?php  echo date('d l',strtotime($d));  ?></th>
        <?php } ?>
        
      <!-- <th>Total Man Hour(s)</th> -->
      <th>Total Absent (Days)</th>
      <th>Total Late (Days)</th>
      <th>Total Leave (Days)</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($user as $row)
    {
      $manhour=0;
      $absent=0;
      $leave=0;
      $late=0;
    ?>
    <tr>
      <td>
        
            <?php echo "<pre>".$row['account_name']."</pre>"; ?>
        
      </td>

    <?php foreach($dates as $key) {   ?>

    <td>
      <?php
      // dd($key['status_name']);
      // $text = isset($monthly_data[$row['user_role_id']][$key]) == null ? "Comming day" : $monthly_data[$row['user_role_id']][$key]['status'];

      // dd($monthly_data[$row['account_id']][$key]['status_name']);

        $text = isset($monthly_data[$row['account_id']][$key]) == null ? "Comming day" : $monthly_data[$row['account_id']][$key]['status_name'];
        // var_dump($text);die();

        if($text=='late')
        {
          echo '<pre><span style="color:orange;">'.
                date('h:i a', strtotime($monthly_data[$row['account_id']][$key]['check_in_time'])).
                '<span>-</span>'.
                date('h:i a', strtotime($monthly_data[$row['account_id']][$key]['check_out_time'])).
                '</span></pre>';
          $late += 1;
        }
        elseif($text=='ot')
        {
          echo '<pre><span style="color:green;">'.
                date('h:i a', strtotime($monthly_data[$row['account_id']][$key]['check_in_time'])).
                '<span>-</span>'.
                date('h:i a', strtotime($monthly_data[$row['account_id']][$key]['check_out_time'])).
                '</span></pre>';
        }
        elseif($text=='absent')
        {
          $absent += 1;
          echo '<pre style="color:red;">'.$text.'</pre>';
        }
        elseif($text=='leave')
        {
          $leave += 1;
         echo '<pre style="color:red;">'.$text.'</pre>';
        }
        elseif($text=='intime')
        {
          echo '<pre style="color:black;">'.$text.'</pre>';
        }
        elseif ($text=='half_day_leave')
        {
          echo '<pre><span>'.
                date('h:i a', strtotime($monthly_data[$row['account_id']][$key]['check_in_time'])).
                '<span>-</span>'.
                date('h:i a', strtotime($monthly_data[$row['account_id']][$key]['check_out_time'])).
                '</span></pre>';
        }
        elseif($text=='full_day_leave')
        {
          $leave += 1;
          echo '<pre style="color:red;">'.$text.'</pre>';
        }
        else
        {
          echo '<pre>'.$text.'</pre>';
        }

        $time = isset($monthly_data[$row['account_id']][$key]['manhour'] ) == null ? "0:00":
        $monthly_data[$row['account_id']][$key]['manhour'];

       
          // $sum1=strtotime($time)-$sum;
          // $sum2 = $sum2+$sum1;
        // $manhour += $time;
        // var_dump($manhour);die();
      ?>
    </td>
    <?php } ?>
      <!-- <td><pre><?php echo "$manhour";?></pre></td> -->
      <td><pre><?php echo "$absent"; ?></pre></td>
      <td><pre><?php echo "$late"; ?></pre></td>
      <td><pre><?php echo "$leave"; ?></pre></td>
    </tr>
    <?php } ?>
  </tbody>

 </table>

</div>




@endsection