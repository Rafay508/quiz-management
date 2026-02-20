-- Users Table (extends Laravel's default users table)
users {
  id (PK)
  name
  email
  password
  role (enum: admin, teacher, student)
  status (active/inactive)
  profile_photo
  created_at
  updated_at
}

-- Categories Table (for organizing quizzes)
categories {
  id (PK)
  name
  description
  status
  created_by (FK -> users.id)
  created_at
  updated_at
}

-- Quizzes Table
quizzes {
  id (PK)
  title
  description
  category_id (FK -> categories.id)
  duration_minutes (integer)
  total_marks (integer)
  pass_marks (integer)
  expiry_date (datetime)
  attempts_allowed (integer)
  shuffle_questions (boolean)
  show_result_immediately (boolean)
  is_published (boolean)
  created_by (FK -> users.id)
  instructions (text)
  status (draft/published/archived)
  created_at
  updated_at
}

-- Questions Table
questions {
  id (PK)
  quiz_id (FK -> quizzes.id)
  question_text (text)
  question_type (enum: mcq, true_false, fill_blank, image_based)
  image_url (nullable)
  marks (integer)
  negative_marks (float, default 0)
  order_position (integer)
  explanation (text)  // explanation for correct answer
  created_at
  updated_at
}

-- Question Options Table
question_options {
  id (PK)
  question_id (FK -> questions.id)
  option_text (text)
  is_correct (boolean)
  image_url (nullable)
  order_position (integer)
  created_at
  updated_at
}

-- Quiz Attempts Table
quiz_attempts {
  id (PK)
  quiz_id (FK -> quizzes.id)
  user_id (FK -> users.id)  // nullable for guest users
  guest_email (nullable)
  guest_name (nullable)
  start_time (datetime)
  end_time (datetime)
  status (in_progress/completed/abandoned)
  score (float)
  percentage (float)
  is_passed (boolean)
  ip_address
  user_agent
  created_at
  updated_at
}

-- User Answers Table
user_answers {
  id (PK)
  quiz_attempt_id (FK -> quiz_attempts.id)
  question_id (FK -> questions.id)
  selected_option_id (FK -> question_options.id, nullable)
  answer_text (text, for fill_blank)
  is_correct (boolean)
  marks_obtained (float)
  created_at
  updated_at
}

-- Leaderboard Table (cached for performance)
leaderboard {
  id (PK)
  quiz_id (FK -> quizzes.id)
  user_id (FK -> users.id)
  total_attempts (integer)
  best_score (float)
  best_percentage (float)
  rank (integer)
  updated_at
}