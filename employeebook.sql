CREATE TABLE IF NOT EXISTS `emp_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `emp_info` (`id`, `emp_id`, `supervisor_id`) VALUES
(1, 1, 1);
CREATE TABLE IF NOT EXISTS `emp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;

INSERT INTO `emp_role` (`id`, `emp_id`, `role_id`) VALUES
(1, 1, 1);
CREATE TABLE IF NOT EXISTS `leave_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(50) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `number_of_days` float(10,1) NOT NULL,
  `reason` text NOT NULL,
  `reject_reason` text,
  `emp_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `approved_by_id` int(11) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `half_day` text,
  `leave_applied_on` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`),
  KEY `approved_by_id` (`approved_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_of_leave` varchar(50) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
INSERT INTO `leave_types` (`id`, `type_of_leave`, `number_of_days`) VALUES
(1, 'Annual', 12),
(2, 'Medical', 5),
(3, 'Maternity', 60),
(4, 'Paternity', 2),
(5, 'Off in lieu', 0),
(6, 'Leave without pay', 0),
(7, 'Optional leave', 5),
(8, 'Compassionate', 4),
(9, 'Relocation', 0);
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;
INSERT INTO `modules` (`id`, `module_name`) VALUES
(1, 'Apply Leave'),
(2, 'View Leave'),
(3, 'View All Employee Leave'),
(4, 'Approve/Reject Leave'),
(5, 'User Management'),
(6, 'Roles Management'),
(7, 'Add Task'),
(8, 'Edit Task'),
(9, 'View Task'),
(10, 'View All Task');
CREATE TABLE IF NOT EXISTS `role_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `check` enum('y','n') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;
INSERT INTO `role_access` (`id`, `role_id`, `module_id`, `check`) VALUES
(1, 1, 1, 'y'),
(2, 1, 2, 'y'),
(3, 1, 3, 'y'),
(4, 1, 4, 'y'),
(5, 1, 5, 'y'),
(6, 1, 6, 'y'),
(7, 1, 7, 'y'),
(8, 1, 8, 'y'),
(9, 1, 9, 'y'),
(10, 1, 10, 'y');
CREATE TABLE IF NOT EXISTS `role_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
INSERT INTO `role_table` (`id`, `role`, `description`) VALUES
(1, 'admin', 'This Role manages the overall management.');
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `estimated_time` varchar(255) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;
CREATE TABLE IF NOT EXISTS `updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `details` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1',
  `date_of_joining` date NOT NULL,
  `dob` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
INSERT INTO `users` (`id`, `username`, `name`, `password`, `email`, `active`, `date_of_joining`, `dob`) VALUES
(1, 'admin', 'Admin', '1a1dc91c907325c69271ddf0c944bc72', 'admin@worldeschool.us', '1', '0000-00-00', '0000-00-00');
ALTER TABLE `emp_info`
  ADD CONSTRAINT `emp_info_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  ALTER TABLE `emp_role`
  ADD CONSTRAINT `emp_role_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;