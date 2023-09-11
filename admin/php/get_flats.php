<?php
require($_SERVER['DOCUMENT_ROOT'] . '/php/get_info.php');

function get_products_td()
{

  $mysql = mysqli_connect(servername, user, password, db);
  $sql = $mysql->query("SELECT * FROM `products`")->fetch_all();
  $result = null;
  foreach ($sql as $item) {
    $id = $item[0];
    $info = get_info_product($id);
    $img = json_decode($info['img'], true)[0]['file_path'];
    $result .= "              
                <th scope='col' class='table-column-pe-0'>
                <div class='form-check'>
                  <input class='form-check-input' type='checkbox' value='' id='datatableCheckAll'>
                  <label class='form-check-label'>
                  </label>
                </div>
              </th>
                <td class='table-column-ps-0'>
                {$info['id']}
                </td>
                <td class='table-column-ps-0'>
                  <a class='d-flex align-items-center' href='./ecommerce-product-details.html'>
                    <div class='flex-shrink-0'>
                      <img alt=\"img\" class='avatar avatar-lg' src='$img' alt='Image Description'>
                    </div>
                    <div class='flex-grow-1 ms-3'>
                      <h5 class='text-inherit mb-0'>{$info['title']}</h5>
                    </div>
                  </a>
                </td>
                <td>{$info['price']}</td>
                <td>{$info['name']}</td>

                <td>{$info['descr']}</td>
                <td>{$info['info']}</td>
                <td>{$info['container']}</td>
                <td>{$info['collection']}</td>

                <td>{$info['availability']}</td>

                <td>{$info['views']}</td>
                <td>
                  <div class='btn-group' role='group'>
                    <a class='btn btn-white btn-sm' href='./ecommerce-product-details.php?id={$info['id']}'>
                      <i class='bi-pencil-fill me-1'></i> Изменить
                    </a>

                    
                    <div class='btn-group'>
                      <button type='button' class='btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty' id='productsEditDropdown1' data-bs-toggle='dropdown' aria-expanded='false'></button>

                      <div class='dropdown-menu dropdown-menu-end mt-1' aria-labelledby='productsEditDropdown1'>
                        <button onclick='del_product(this.getAttribute(\"value\"))' value='{$info['id']}' class='dropdown-item' href='#'>
        <i class='bi-trash dropdown-item-icon'></i> Удалить
                        </button>
   
    
                      </div>
                    </div>
                    
                  </div>
                </td>
              </tr>";
  }
  return  $result;
}
