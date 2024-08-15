<?php
namespace Emutoday\Helpers\Interfaces;
/**
 * The interface for the Bug service
 *
 * @author cpuzzuol
 */
interface IBug {
    public function getUnapprovedAnnouncements();
    public function getUnapprovedEvents();
    public function getUnapprovedStories();
    public function getUnapprovedExperts();
    public function getNewExpertMediaRequests();
		public function getNewInsideemuIdeas();
}
