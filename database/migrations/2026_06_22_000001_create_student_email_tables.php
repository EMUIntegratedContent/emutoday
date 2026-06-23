<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates all tables for the "The Week at EMU: Students" email builder (StudentEmail).
 * Mirrors the original Email feature tables, dropping president/emu175 columns and the
 * featured-story "order" (a student email has exactly one featured item).
 */
return new class extends Migration {
    public function up(): void
    {
        // Main table
        Schema::create('student_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subheading')->nullable();
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('is_ready')->default(0);
            $table->integer('clone_student_email_id')->unsigned()->nullable(); // if cloned, mark from which one
            $table->dateTime('send_at')->nullable();
            $table->tinyInteger('is_sent')->default(0);
            $table->integer('mailgun_opens')->default(0); // incremented by Mailgun webhooks
            $table->integer('mailgun_clicks')->default(0);
            $table->integer('mailgun_spam')->default(0);
            $table->tinyInteger('exclude_events')->default(0);
            $table->tinyInteger('exclude_insideemu')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('clone_student_email_id')
                ->references('id')->on('student_emails')
                ->onDelete('set null');
        });

        // Featured story (exactly one per email; polymorphic Story OR Campus Life/Inside EMU post)
        Schema::create('student_email_mainstory', function (Blueprint $table) {
            $table->integer('student_email_id')->unsigned()->index();
            $table->integer('story_id')->unsigned()->nullable()->index();
            $table->unsignedBigInteger('insideemu_post_id')->nullable()->index();
            $table->timestamps();

            $table->primary('student_email_id'); // one featured item per email
            $table->foreign('student_email_id')->references('id')->on('student_emails')->onDelete('cascade');
            $table->foreign('story_id')->references('id')->on('storys')->onDelete('cascade');
            $table->foreign('insideemu_post_id')->references('id')->on('insideemu_posts')->onDelete('cascade');
        });

        // More News (side stories listing)
        Schema::create('student_email_story', function (Blueprint $table) {
            $table->integer('student_email_id')->unsigned()->index();
            $table->integer('story_id')->unsigned()->index();
            $table->integer('order');
            $table->timestamps();

            $table->primary(['student_email_id', 'story_id']);
            $table->foreign('student_email_id')->references('id')->on('student_emails')->onDelete('cascade');
            $table->foreign('story_id')->references('id')->on('storys')->onDelete('cascade');
        });

        // Campus Life (Inside EMU posts)
        Schema::create('student_email_insideemu', function (Blueprint $table) {
            $table->integer('student_email_id')->unsigned()->index();
            $table->unsignedBigInteger('insideemu_post_id')->index();
            $table->integer('order');
            $table->timestamps();

            $table->primary(['student_email_id', 'insideemu_post_id']);
            $table->foreign('student_email_id')->references('id')->on('student_emails')->onDelete('cascade');
            $table->foreign('insideemu_post_id')->references('id')->on('insideemu_posts')->onDelete('cascade');
        });

        // Announcements
        Schema::create('student_email_announcement', function (Blueprint $table) {
            $table->integer('student_email_id')->unsigned()->index();
            $table->integer('announcement_id')->unsigned()->index();
            $table->integer('order');
            $table->timestamps();

            $table->primary(['student_email_id', 'announcement_id']);
            $table->foreign('student_email_id')->references('id')->on('student_emails')->onDelete('cascade');
            $table->foreign('announcement_id')->references('id')->on('announcements')->onDelete('cascade');
        });

        // What's Happening at EMU (calendar events)
        Schema::create('student_email_event', function (Blueprint $table) {
            $table->integer('student_email_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
            $table->integer('order');
            $table->timestamps();

            $table->primary(['student_email_id', 'event_id']);
            $table->foreign('student_email_id')->references('id')->on('student_emails')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('cea_events')->onDelete('cascade');
        });

        // Separate student mailing lists
        Schema::create('student_mailinglists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_address')->unique();
            $table->string('description')->nullable();
            $table->tinyInteger('show')->default(1);
            $table->timestamps();
        });

        Schema::create('student_email_recipients', function (Blueprint $table) {
            $table->integer('student_email_id')->unsigned()->index();
            $table->integer('student_mailinglist_id')->unsigned()->index();
            $table->timestamps();

            $table->primary(['student_email_id', 'student_mailinglist_id']);
            $table->foreign('student_email_id')->references('id')->on('student_emails')->onDelete('cascade');
            $table->foreign('student_mailinglist_id')->references('id')->on('student_mailinglists')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_email_recipients');
        Schema::dropIfExists('student_mailinglists');
        Schema::dropIfExists('student_email_event');
        Schema::dropIfExists('student_email_announcement');
        Schema::dropIfExists('student_email_insideemu');
        Schema::dropIfExists('student_email_story');
        Schema::dropIfExists('student_email_mainstory');
        Schema::dropIfExists('student_emails');
    }
};
