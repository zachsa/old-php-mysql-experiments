      <table>
        
        <thead>
          
          <tr>
            <?php foreach($content[0] as $field_name=>$val):?>
              <?php echo "<th>".$field_name."</th>"; ?>
            <? endforeach?>
            <th></th>
          </tr>
        
        </thead>
        
        <tbody>
          
          	<?php for ($i=0; $i<count($content); $i++): ?>
          	<form action="" method="post" name="delete_form<?php echo $i ?>">
   
	            <tr>

   	        		<?php foreach($content[$i] as $field_val): ?>
              			<td><?php echo $field_val ?></td>
            		<?php endforeach ?>

            		<td>
            			<input type="hidden" id="delete[TABLE_NAME][<?php $i ?>]" name="delete[TABLE_NAME][<?php $i ?>]" value="<?php echo $content[$i]['SOME_ID'] ?>"/>
            			<input type="submit" id="" value="Delete"/>
            		</td>

            	</tr>
            </form>
          	<?php endfor ?>
        
        </tbody>
      
      </table>