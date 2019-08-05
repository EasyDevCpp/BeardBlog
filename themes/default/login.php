<?php
/*
BeardBlog - Block based pagebuilding CMS
Copyright (C) 2018  Robin Krause

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

$MACROPAGES_TITLE["login"]="Login";
$MACROPAGES_DESCRIPTION["login"]="Login page.";
$MACROPAGES_KEYWORDS["login"]="Login";

function BBThemeLogin() {
  ?>
  <section class="fdb-block" style="background-image: url(./themes/default/imgs/bg_1.svg)">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-left">
          <div class="fdb-box">
            <div class="row">
              <div class="col">
                <h1>Log In</h1>
                <p class="text-h3">Insert your data.</p>
              </div>
            </div>
            <?php echo "<form action=\"?site=".$_GET["site"]."&page=login&submit=true\" method=\"POST\">"; ?>
              <div class="row">
                <div class="col mt-4">
                  <label>E-Mail:</label>
                  <input class="form-control" name="email" placeholder="E-Mail" type="email" required>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col">
                  <label>Password:</label>
                  <input class="form-control" name="password" placeholder="Password" type="password">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col">
                  <button class="btn btn-round" type="submit">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
}
?>
