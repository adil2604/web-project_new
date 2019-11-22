<div id="today"> <?php
pagination(10,1);
?>>
    <div class="info">
        <div class="title">
            Today tasks
        </div>
    </div>
    <div class="tasks">
        <?php
        $count = 10;
        set_tasks($data,$count);
        ?>

    </div>

</div>



