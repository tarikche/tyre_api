import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';
import $ from 'jquery';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

registerReactControllerComponents(require.context('./react/Components', true, /\.(j|t)sx?$/));



  $('button[data-action="add-to-cart"]').on('click', function(e) {
    e.preventDefault();
    let tyre_id = $(this).parent().find('input[name="tyre_id"]').val();
    let quantity = $(this).parent().find('input[name="quantity"]').val();
    let data = {
        tyre_id: tyre_id,
        quantity: quantity
    }
    console.log('clicked');
    $.ajax({
        url: '/add-to-cart',
        method: 'POST',
        data: data,
        type: 'json',
        success: function(response) {
            console.log('success');
            
        }
    })
})