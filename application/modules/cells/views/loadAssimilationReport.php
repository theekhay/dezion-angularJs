


<!-- <div class="row"> -->
	<div class="col-md-12 col-xs-12">
		<table class="table table-bordered table-hover">
			<th>Week Number</th>
			<th>Duration</th>
			<th>Confirmed Members</th>
			<th>Assinged</th>
			<th>Guests</th>
			<th>Total</th>

			<?php foreach ($week_list as $week): ?>
				<?php if($year == $current_year ): ?>
					<?php if($week <= $this->date_time->this_week() ): ?>
						<?php
							$count = 0 ;
							$week_start = $this->date_time->week_start_within_month($week, $month, $year);
			                $week_end   = $this->date_time->week_end_within_month($week, $month, $year);
			                $cat[]      = $week_start." to ".$week_end ;

			                $all 	    = $this->mdl_cell_members->members_in_cell($cell_id, $week_start, $week_end);
			                $all_count  = $all->num_rows();
			                //var_dump($all->result()) ;

			                $confirmed  = $this->mdl_cell_members->get_confirmed($cell_id, $week_start, $week_end);
			                $confirmed_count = $confirmed->num_rows();

			                $assigned = $all_count - $confirmed_count ;
			                $guests = 0 ;
						?>

						<tr>
							<td>Week<?= $week++ ?></td>
							<td><?= $this->date_time->format($week_start, 'M-d'); ?> to <?= $this->date_time->format($week_end, 'M-d'); ?></td>
							<td><?= $confirmed_count ?></td>
							<td><?= $assigned ?></td>
							<td><?= $guests ?></td>
							<td><?= $confirmed_count + $assigned + $guests ; ?></td>
							
						</tr>


					<?php endif; ?>

					<?php elseif($year != $current_year && $year < $current_year): ?>
						<?php
							$count = 0 ;
							$week_start = $this->date_time->week_start_within_month($week, $month, $year);
			                $week_end   = $this->date_time->week_end_within_month($week, $month, $year);
			                $cat[]      = $week_start." to ".$week_end ;

			                $all 	    = $this->mdl_cell_members->members_in_cell($cell_id, $week_start, $week_end);
			                $all_count  = $all->num_rows();

			                $confirmed  = $this->mdl_cell_members->get_confirmed($cell_id, $week_start, $week_end);
			                $confirmed_count = $confirmed->num_rows();

			                $assigned = $all_count - $confirmed_count ;
			                $guests = 0 ;
						?>
						<tr>
							<td>Week<?= $week++ ?></td>
							<td><?= $this->date_time->format($week_start, 'M-d'); ?> to <?= $this->date_time->format($week_end, 'M-d'); ?></td>
							<td><?= $confirmed_count ?></td>
							<td><?= $assigned ?></td>
							<td><?= $guests ?></td>
							<td><?= $confirmed_count + $assigned + $guests ; ?></td>
							
						</tr>

					<?php else:?>
						

				<?php endif; ?>	

			<?php endforeach; ?>	
		</table>
	</div>
<!--</div>-->