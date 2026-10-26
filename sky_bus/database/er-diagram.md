USE `ticket_booking_db`;

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password_hash`, `role`, `is_active`) VALUES
(1, 'Admin User', 'admin@skybus.local', '9999999999', '$2y$10$Y3hEjvH8KWWOsW60cIr7M.J0KxN6hBZ5PMa7JU0UtBy0xv04pacnW', 'admin', 1),
(2, 'Arshil Mogal', 'arshil@example.com', '9876543210', '$2y$10$FoqJR7d2xK9wJ1LtcKgtpO8nv1m8v4dF8POub0mUeG9T7Aq3P0Y2m', 'user', 1),
(3, 'Sample User', 'user@example.com', '9123456780', '$2y$10$eDEYybZ9Y2JzCFh4W7zJwOlH2c6f4YHOh0m3q0l4k8Z4ptH/6p8kG', 'user', 1);

INSERT INTO `admins` (`user_id`, `full_name`) VALUES (1, 'Admin User');

INSERT INTO `bus_operators` (`id`, `name`, `email`, `phone`, `address`, `is_active`) VALUES
(1, 'Blue Star Travels', 'hello@bluestartravels.in', '9876500011', 'Bengaluru', 1),
(2, 'Royal Roadways', 'support@royalroadways.in', '9876500022', 'Pune', 1),
(3, 'Skyline Buses', 'hello@skylinebuses.in', '9876500033', 'Hyderabad', 1);

INSERT INTO `cities` (`id`, `name`, `state`, `is_active`) VALUES
(1, 'Bengaluru', 'Karnataka', 1),
(2, 'Mumbai', 'Maharashtra', 1),
(3, 'Pune', 'Maharashtra', 1),
(4, 'Hyderabad', 'Telangana', 1),
(5, 'Chennai', 'Tamil Nadu', 1),
(6, 'Delhi', 'Delhi', 1),
(7, 'Jaipur', 'Rajasthan', 1),
(8, 'Ahmedabad', 'Gujarat', 1),
(9, 'Kolkata', 'West Bengal', 1),
(10, 'Lucknow', 'Uttar Pradesh', 1);

INSERT INTO `routes` (`id`, `source_city_id`, `destination_city_id`, `distance_km`, `is_active`) VALUES
(1, 1, 3, 560.00, 1),
(2, 3, 2, 140.00, 1),
(3, 4, 1, 570.00, 1),
(4, 1, 6, 1750.00, 1),
(5, 2, 8, 530.00, 1),
(6, 5, 1, 330.00, 1);

INSERT INTO `route_stops` (`route_id`, `city_id`, `stop_order`) VALUES
(1, 1, 1), (1, 3, 2),
(2, 3, 1), (2, 2, 2),
(3, 4, 1), (3, 1, 2),
(4, 1, 1), (4, 6, 2),
(5, 2, 1), (5, 8, 2),
(6, 5, 1), (6, 1, 2);

INSERT INTO `boarding_points` (`route_id`, `name`, `address`) VALUES
(1, 'Majestic', 'Majestic Bus Stand, Bengaluru', 1),
(1, 'Electronic City', 'Electronic City, Bengaluru', 1),
(2, 'Shivaji Nagar', 'Shivaji Nagar, Pune', 1),
(2, 'Viman Nagar', 'Viman Nagar, Pune', 1),
(3, 'Secunderabad', 'Secunderabad Stand, Hyderabad', 1),
(3, 'Madhapur', 'Madhapur, Hyderabad', 1),
(4, 'KSR Bengaluru', 'KSR Bengaluru', 1),
(5, 'Andheri', 'Andheri East', 1),
(6, 'Chennai Central', 'Chennai Central', 1);

INSERT INTO `dropping_points` (`route_id`, `name`, `address`) VALUES
(1, 'Pune Station', 'Pune Railway Station', 1),
(1, 'Swargate', 'Swargate, Pune', 1),
(2, 'Mumbai Central', 'Mumbai Central', 1),
(2, 'Andheri', 'Andheri', 1),
(3, 'Bengaluru Majestic', 'Majestic, Bengaluru', 1),
(3, 'Kormangala', 'Kormangala, Bengaluru', 1),
(4, 'Delhi ISBT', 'Delhi ISBT', 1),
(5, 'Ahmedabad Railway', 'Ahmedabad Railway Station', 1),
(6, 'Bengaluru Majestic', 'Majestic, Bengaluru', 1);

INSERT INTO `buses` (`id`, `operator_id`, `bus_name`, `bus_number`, `bus_type`, `seat_layout`, `total_seats`, `is_active`) VALUES
(1, 1, 'Blue Star Express', 'KA-01-AB-3214', 'AC', '2x2', 40, 1),
(2, 2, 'Royal Comfort', 'MH-12-CD-4567', 'NON_AC', '2x2', 36, 1),
(3, 3, 'Skyline Deluxe', 'TS-09-EF-2024', 'SLEEPER', '2x1', 28, 1);

INSERT INTO `bus_seats` (`bus_id`, `seat_number`, `seat_row`, `seat_column`, `status`) VALUES
(1, '1A', '1', 'A', 'available'), (1, '1B', '1', 'B', 'available'), (1, '1C', '1', 'C', 'available'), (1, '1D', '1', 'D', 'available'),
(1, '2A', '2', 'A', 'available'), (1, '2B', '2', 'B', 'available'), (1, '2C', '2', 'C', 'available'), (1, '2D', '2', 'D', 'available'),
(1, '3A', '3', 'A', 'available'), (1, '3B', '3', 'B', 'available'), (1, '3C', '3', 'C', 'available'), (1, '3D', '3', 'D', 'available'),
(1, '4A', '4', 'A', 'available'), (1, '4B', '4', 'B', 'available'), (1, '4C', '4', 'C', 'available'), (1, '4D', '4', 'D', 'available'),
(2, '1A', '1', 'A', 'available'), (2, '1B', '1', 'B', 'available'), (2, '1C', '1', 'C', 'available'), (2, '1D', '1', 'D', 'available'),
(2, '2A', '2', 'A', 'available'), (2, '2B', '2', 'B', 'available'), (2, '2C', '2', 'C', 'available'), (2, '2D', '2', 'D', 'available'),
(2, '3A', '3', 'A', 'available'), (2, '3B', '3', 'B', 'available'), (2, '3C', '3', 'C', 'available'), (2, '3D', '3', 'D', 'available'),
(3, '1L', '1', 'L', 'available'), (3, '1U', '1', 'U', 'available'), (3, '2L', '2', 'L', 'available'), (3, '2U', '2', 'U', 'available'),
(3, '3L', '3', 'L', 'available'), (3, '3U', '3', 'U', 'available'), (3, '4L', '4', 'L', 'available'), (3, '4U', '4', 'U', 'available');

INSERT INTO `schedules` (`id`, `bus_id`, `route_id`, `travel_date`, `departure_time`, `arrival_time`, `fare`, `status`) VALUES
(1, 1, 1, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '21:30:00', '03:30:00', 850.00, 'active'),
(2, 2, 2, DATE_ADD(CURDATE(), INTERVAL 2 DAY), '19:45:00', '22:30:00', 620.00, 'active'),
(3, 3, 3, DATE_ADD(CURDATE(), INTERVAL 3 DAY), '22:00:00', '06:00:00', 980.00, 'active');

INSERT INTO `schedule_seats` (`schedule_id`, `seat_number`, `status`) VALUES
(1, '1A', 'available'), (1, '1B', 'available'), (1, '1C', 'available'), (1, '1D', 'available'),
(1, '2A', 'available'), (1, '2B', 'available'), (1, '2C', 'available'), (1, '2D', 'available'),
(1, '3A', 'available'), (1, '3B', 'available'), (1, '3C', 'available'), (1, '3D', 'available'),
(1, '4A', 'available'), (1, '4B', 'available'), (1, '4C', 'available'), (1, '4D', 'available'),
(2, '1A', 'available'), (2, '1B', 'available'), (2, '1C', 'available'), (2, '1D', 'available'),
(2, '2A', 'available'), (2, '2B', 'available'), (2, '2C', 'available'), (2, '2D', 'available'),
(2, '3A', 'available'), (2, '3B', 'available'), (2, '3C', 'available'), (2, '3D', 'available'),
(3, '1L', 'available'), (3, '1U', 'available'), (3, '2L', 'available'), (3, '2U', 'available'),
(3, '3L', 'available'), (3, '3U', 'available'), (3, '4L', 'available'), (3, '4U', 'available');

INSERT INTO `coupons` (`id`, `code`, `description`, `discount_type`, `discount_value`, `minimum_amount`, `is_active`, `expires_at`, `max_usage_total`, `max_usage_per_user`) VALUES
(1, 'NEWUSER10', '10% off for new customers', 'percent', 10.00, 500.00, 1, DATE_ADD(NOW(), INTERVAL 30 DAY), 100, 1),
(2, 'FLAT100', 'Flat ₹100 off', 'fixed', 100.00, 1000.00, 1, DATE_ADD(NOW(), INTERVAL 60 DAY), 50, 2);

INSERT INTO `bookings` (`id`, `user_id`, `schedule_id`, `pnr`, `booking_reference`, `status`, `payment_status`, `base_fare`, `service_fee`, `coupon_discount`, `total_amount`, `travel_date`) VALUES
(1, 2, 1, 'SB1A2B3C4', 'BK-20260101-001', 'confirmed', 'paid', 1700.00, 80.00, 100.00, 1680.00, DATE_ADD(CURDATE(), INTERVAL 1 DAY));

INSERT INTO `passengers` (`booking_id`, `name`, `age`, `gender`, `seat_number`) VALUES (1, 'Arshil Mogal', 25, 'male', '1A');
INSERT INTO `booking_seats` (`booking_id`, `schedule_id`, `seat_number`, `fare`) VALUES (1, 1, '1A', 850.00);
INSERT INTO `payments` (`booking_id`, `payment_method`, `payment_reference`, `amount`, `status`, `gateway`, `notes`) VALUES
(1, 'demo_payment', 'DEMO-REF-1001', 1680.00, 'paid', 'demo', 'Demo simulated payment');
INSERT INTO `notifications` (`user_id`, `title`, `message`, `type`, `is_read`) VALUES
(2, 'Booking Confirmed', 'Your bus booking has been confirmed.', 'success', 0),
(2, 'Payment Received', 'Payment for booking SB1A2B3C4 is successful.', 'info', 0);

