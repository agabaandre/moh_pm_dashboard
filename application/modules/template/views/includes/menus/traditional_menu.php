<?php
$subjects = Modules::run('kpi/subjectData');

foreach ($subjects as $subject):
    ?>
    <li
        class="treeview <?php if ($subject->id == $this->uri->segment(3) || $subject->id == $this->uri->segment(4)) {
            echo "active";
        } ?>">
        <?php
        $url = base_url() . "data/subject/" . $subject->id . "/" . str_replace(',', ' ', str_replace("'", " ", str_replace('&', 'and', str_replace("+", "_", urlencode($subject->name))))); ?>
        <a href="" target="_self" onclick="openUrl('<?php echo $url; ?>');">
            <i class="fa fa-<?php echo $subject->icon; ?>"></i><span>
                <?php echo $subject->subject_short_name; ?>
            </span>
            <span class="pull-right-container pull-right">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <?php $kpis = Modules::run('Kpi/dashkpi', $subject->id);
            foreach ($kpis as $kpi): ?>
                <li data-toggle="tooltip" data-placement="right" title="<?php echo $kpi->short_name; ?>" style="z-index:1000;">
                    <a href="<?php echo base_url() . 'data/kpiData/' . $kpi->kpi_id . '/' . $subject->id; ?>"
                        class="text-truncate"><?php echo $kpi->short_name; ?></a> </li>
            <?php endforeach; ?>
        </ul>
    </li>

<?php endforeach;


?>