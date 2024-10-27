->where(function ($query) use ($pickupTime, $arriveTime) {
            $query->where(function ($subQuery) use ($pickupTime, $arriveTime) {
                $subQuery->where('pickup_time', '>', $pickupTime)
                        ->where('pickup_time', '>', $arriveTime);
            })->orWhere(function ($subQuery) use ($pickupTime, $arriveTime) {
                $subQuery->where('arrive_time', '<', $pickupTime)
                        ->where('arrive_time', '<', $arriveTime);
            });
        })