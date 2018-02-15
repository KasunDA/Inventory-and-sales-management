
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title text text-center" id="exampleModalLabel">Détails de l'achat</h2>
      </div>
      <div class="modal-content">
      <div class="col-lg-12 col-md-12">
            	<table class="items-list col-lg-12 col-md-12 table-hover">
              	<tbody>
              	<tr>
                  <th>Nom Produit</th>
                  <th>stock</th>
                  <th>Prix Unitaire</th>
                  <th>Quantité</th>
                  <th>Total</th>
                  <th>Supprimer</th>
                </tr>
                <!--Item-->
                <?php 
                  if(isset($cart) && is_array($cart) && count($cart)){
                  $i=1;
                  foreach ($cart as $key => $data) { 
                  ?>
                <tr class="item first rowid<?php echo $data['rowid'] ?>">
                  
                  <!--td><?php echo $data['codeProd'] ?></td-->
                  <td class="name"><?php echo strtoupper($data['name']) ?></td>
                  <td><?php echo $data['stock'] ?></td>
                  <td class="price">FCFA <b><span class="price<?php echo $data['rowid'] ?> text text-danger"><?php echo $data['price'] ?></span></b></td>
                  <td class="qnt-count">
                    <input class="quantity qty<?php echo $data['rowid'] ?> form-control" name="qty" type="number" min="1" max="<?php echo $data['stock'] ?>" value="<?php echo $data['qty'] ?>">
                      
                    <span class="Update" onclick="javascript:updateproduct('<?php echo $data['rowid'] ?>')">Update</span>
                  </td>
                  <td class="total">FCFA <b> <span class="subtotal subtotal<?php echo $data['rowid'] ?> text text-info"><?php echo $data['subtotal'] ?></span> </b></td>
                  <td class="delete text text-center"><i class="icon-delete" onclick="javascript:deleteproduct('<?php echo $data['rowid'] ?>')">X</i></td>
                </tr>

                <?php
                  $i++;
                    } }
                ?>
               
                <tr class="item">
                  <td class="thumb" colspan="4" align="right">&nbsp;</td>
                  <td class="text text-success">TOTAL:<b> FCFA <span class="grandtotal">0</span> </b></td>
                  <td>&nbsp;</td>
                </tr>
              </tbody></table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="javascript:deleteproduct('all')">Tout Supprimer</button>
        <!--a href="<?php echo site_url('sellController/enregistrer') ?>"><button type="button" class="btn btn-primary">Valider</button></a-->
        <a href="#" onclick="if(confirm('Are you sure to proceed ?')){ location='<?php echo site_url('sellController/enregistrer') ?>';}">
          <button type="button" class="btn btn-primary">Valider</button>
        </a>

      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
function deleteproduct(rowid)
{
var answer = confirm ("Etes vous sûr de vouloir supprimer cet élément?");
if (answer)
{
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('sellController/remove');?>",
                data: "rowid="+rowid,
                success: function (response) {
                    $(".rowid"+rowid).remove(".rowid"+rowid); 
                    $(".cartcount").text(response);  
                    var total = 0;
                    $('.subtotal').each(function(){
                        total += parseInt($(this).text());
                        $('.grandtotal').text(total);
                    });              
                }
            });
      }
}

var total = 0;
$('.subtotal').each(function(){
    total += parseInt($(this).text());
    $('.grandtotal').text(total);
});


function updateproduct(rowid)
{
var qty = $('.qty'+rowid).val();
var price = $('.price'+rowid).text();
var subtotal = $('.subtotal'+rowid).text();
    $.ajax({
            type: "POST",
            url: "<?php echo site_url('sellController/update_cart');?>",
            data: "rowid="+rowid+"&qty="+qty+"&price="+price+"&subtotal="+subtotal,
            success: function (response) {
                    $('.subtotal'+rowid).text(response);
                    var total = 0;
                    $('.subtotal').each(function(){
                        total += parseInt($(this).text());
                        $('.grandtotal').text(total);
                    });     
            }
        });
}


</script>