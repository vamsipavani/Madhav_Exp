SELECT substr(cat_code,1,4),sum(exp_amount)
                 from expenses exp, exp_categories ec
                 where exp.cat_id = ec.cat_id
                 and cycle_id = ".$maxCycleId." group by ec.cat_id
                 order by sum(exp_amount);