<?php
/**
 * Created by PhpStorm.
 * User: Jane
 * Date: 12/13/2018
 * Time: 8:30 PM
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/app.css">
      <style>
          .center{
              margin: auto;
          }
          #title{
              width: 200px;
          }
          .table{
              margin-top: 30px !important;
          }
          .title{
              margin-top: 20px !important;
          }
          @media screen and (max-width: 800px) {
              .is-responsive {
                  width: 100%;
                  border-collapse: collapse;
                  border-spacing: 0;
                  display: block;
                  position: relative;
              }
              .is-responsive td:empty:before {
                  content: " ";
              }
              .is-responsive th,
              .is-responsive td {
                  margin: 0;
                  vertical-align: top;
              }
              .is-responsive th {
                  text-align: left;
              }
              .is-responsive thead {
                  border-right: solid 2px #dbdbdb;
                  display: block;
                  float: left;
              }
              .is-responsive thead tr {
                  display: block;
                  padding: 0 10px 0 0;
              }
              .is-responsive thead tr th::before {
                  content: " ";
              }
              .is-responsive thead td,
              .is-responsive thead th {
                  border-width: 0 0 1px;
              }
              .is-responsive tbody {
                  display: block;
                  width: auto;
                  position: relative;
                  overflow-x: auto;
                  white-space: nowrap;
              }
              .is-responsive tbody tr {
                  display: inline-block;
                  vertical-align: top;
              }
              .is-responsive th {
                  display: block;
                  text-align: right;
              }
              .is-responsive td {
                  display: block;
                  min-height: 1.25em;
                  text-align: left;
              }
              .is-responsive th:last-child,
              .is-responsive td:last-child {
                  border-bottom-width: 0;
              }
              .is-responsive tr:last-child td:not(:last-child) {
                  border: 1px solid #dbdbdb;
                  border-width: 0 0 1px;
              }
              .is-responsive.is-bordered td,
              .is-responsive.is-bordered th {
                  border-width: 1px;
              }
              .is-responsive.is-bordered tr td:last-child,
              .is-responsive.is-bordered tr th:last-child {
                  border-bottom-width: 1px;
              }
              .is-responsive.is-bordered tr:last-child td,
              .is-responsive.is-bordered tr:last-child th {
                  border-width: 1px;
              }
          }
      </style>
  </head>
  <body>
      <div class="container">
          <div id = "title" class="center">
          <h1  class="title is-2 is-vcentered">Rules data</h1>
          </div>
          <div>
              <a href="{{url('/pdfview/pdf')}}" class = "is-pulled-right">Convert to PDF</a>
          </div>
          <div class="demo">

              <table class="table is-responsive center">
                  <thead>
                  <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Description</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($rules_data as $rule)
                      <tr>
                          <td><img src = "{{URL::to('/').$rule->image}}" alt="Placeholder image"></td>
                          <td>{{$rule->title}}</td>
                          <td>{{$rule->description}}</td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>

          </div>

      </div>
  </body>
</html>