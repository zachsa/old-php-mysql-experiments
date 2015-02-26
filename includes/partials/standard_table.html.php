      <table>
        
        <thead>
          
          <tr>
            <?php foreach($content[1][0] as $field_name=>$val):?>
              <?php echo "<th>".$field_name."</th>"; ?>
            <? endforeach ?>
            <th></th>
            <th></th>
          </tr>
        
        </thead>
        
        <tbody>
          
          	<?php for ($i=0; $i < count($content[1]); $i++): ?>
          	<form action="" method="post" name="delete_form<?php echo $i ?>">
   
	            <tr>

   	        		<?php foreach($content[1][$i] as $field_val): ?>
              			<td><?php echo $field_val ?></td>
            		<?php endforeach ?>


            		<td>
            			<input type="hidden" id='<?php echo "delete[$content[1]][$i]" ?>' name="delete[<? echo $content[0] ?>][<?php $i ?>]" value="<?php echo $content[1][$i][$content[2]] ?>"/>
            			<input type="hidden" id='options[id]_generic' name="options[id]" value="<?php echo $content[2] ?>" ?>
            			<input type="submit" id="" value="Delete"/>
            		</td>

            	</tr>
            </form>
          	<?php endfor ?>
        
        </tbody>
      
      </table>