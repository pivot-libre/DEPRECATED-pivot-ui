<?php
session_start();
require_once("head.html");
// require_once("core/dom.php");

if (isset($_SESSION["rankingsJson"])) { $rankingsJson = $_SESSION["rankingsJson"]; }
else { $rankingsJson = file_get_contents("unrankedBallot.json"); }
$rankings = json_decode($rankingsJson, true);
// error_log(print_r($rankings, true));
?>

<body>
  <div id="backgrounddiv">
    <div class="backgroundheader"></div>
    <div id="ballotdiv">
      <div class="ballotheader">City of Madison Operating Budget - 2018</div>
      <div class="stepnav">
        <a href="ballot.php">Rank items</a>
        <a>Review</a>
        <a href="#">Cast ballot</a>
      </div>
      <div class="ballotspace">
        <div class="ballotspaceheader">
          <div id="ballotspaceheaderline1">Review</div>
        </div>
        <ol id="rankeditems" class="ballotselections">
          <?php
          $rank = 0;
          foreach ($rankings["ranked"] as $item) {
              ballotselection(++$uniq, $item["description"], "(-$225,000)", $item["tie"]);
          }
          // ballotselection(++$rank, "Approve RFP and 1-year seed-funding for Participatory Budgeting experiment", "(-$225,000)");
          // ballotselection(++$rank, "and 1-year seed-funding for Participatory Budgeting experiment", "(-$225,000)");
          // ballotselection(++$rank, "adsfas RFP and 1-year seed-funding for Participatory Budgeting experiment", "(-$125,000)");
          // ballotselection(++$rank, "Approve RFP and 1-year seed-funding for Participatory Budgeting experiment", "(-$225,000)");
          // ballotselection(++$rank, "funding for Participatory Budgeting experiment", "(-$225,000)");
          ?>
        </ol>
        <ol id="unrankeditems" class="ballotselections">
          <?php
          foreach ($rankings["unranked"] as $item) {
              ballotselection(++$uniq, $item["description"], "(-$225,000)");
          }
          // ballotselection(++$rank, "funding for Participatory Budgeting experiment", "(-$225,000)");
          // ballotselection(++$rank, "Participatory Budgeting experiment", "(-$225,000)");
          // ballotselection(++$rank, "funding for Participatory Budgeting experiment", "(-$225,000)");
          ?>
        </ol>
      </div>
    </div>
  </div>
  <!-- <script src="dragula/dragula.js"></script> -->
  <!-- <script src="saveRankings.js"></script> -->
</body>
</html>

<?php
function ballotselection($uniq, $description, $cost, $tie = "") {
  if (!$tie) { $tie = ""; }
  else { $tie = ' data-tie="' . $tie . '"'; }
echo <<<HTML
  <!-- <li class="ballotselection" onclick="ballotItemClick(this)"$tie> -->
  <li class="ballotselection"$tie>
    <!-- <label class="ballotrank" for="ballotcheck-$uniq"> -->
    <div class="ballotrank ballotreview">
      <!-- <input type="checkbox" name="ballotcheck" id="ballotcheck-$uniq"></input> -->
      <!-- <div class="tie" onclick="processSelected(event,tieSelected)"></div> -->
      <!-- <div class="banish" onclick="processSelected(event,banish)"></div> -->
      <div class="rankdisplay"></div>
    </div>
    <!-- <div class="grippy"></div> -->
    <div class="ballotdescription">$description</div>
    <div class="ballotcost">$cost</div>
  </li>
HTML;
  }
?>
</html>
