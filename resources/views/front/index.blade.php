@extends('front.layouts.app')
@section('title', 'QuizMaster - Online Quiz Management & Assessment Platform')

@section('content')
    <!-- Courses Hero Section -->
    <section id="courses-hero" class="courses-hero section light-background">

      <div class="hero-content">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="hero-text">
                <h1>Challenge Yourself with QuizMaster</h1>
                <p>QuizMaster is an advanced quiz management platform that allows users to create, manage, and attempt quizzes effortlessly. Test your knowledge, track your performance, and improve your skills across multiple categories anytime, anywhere.</p>

                <div class="hero-stats">
                  <div class="stat-item">
                    <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="15000" data-purecounter-duration="2"></span>
                    <span class="label">Total Quiz Attempts</span>
                  </div>
                  <div class="stat-item">
                    <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="250" data-purecounter-duration="2"></span>
                    <span class="label">Available Quizzes</span>
                  </div>
                  <div class="stat-item">
                    <span class="number purecounter" data-purecounter-start="0" data-purecounter-end="87" data-purecounter-duration="2"></span>
                    <span class="label">Average Score %</span>
                  </div>
                </div>

                <div class="hero-buttons">
                  <a href="#quizzes" class="btn btn-primary">Browse Quizzes</a>
                  <a href="#how-it-works" class="btn btn-outline">How It Works</a>
                </div>

                <div class="hero-features">
                  <div class="feature">
                    <i class="bi bi-shield-check"></i>
                    <span>Instant Results & Analytics</span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-clock"></i>
                    <span>Timed & Practice Modes</span>
                  </div>
                  <div class="feature">
                    <i class="bi bi-people"></i>
                    <span>Multiple Quiz Categories</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
              <div class="hero-image">
                <div class="main-image">
                  <img src="{{ asset('assets/front/img/education/courses-13.webp') }}" alt="Online Learning" class="img-fluid">
                </div>

                <div class="floating-cards">
                  <div class="course-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-icon">
                      <i class="bi bi-code-slash"></i>
                    </div>
                    <div class="card-content">
                      <h6>Web Development</h6>
                      <span>2,450 Students</span>
                    </div>
                  </div>

                  <div class="course-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-icon">
                      <i class="bi bi-palette"></i>
                    </div>
                    <div class="card-content">
                      <h6>UI/UX Design</h6>
                      <span>1,890 Students</span>
                    </div>
                  </div>

                  <div class="course-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="card-icon">
                      <i class="bi bi-graph-up"></i>
                    </div>
                    <div class="card-content">
                      <h6>Digital Marketing</h6>
                      <span>3,200 Students</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="hero-background">
        <div class="bg-shapes">
          <div class="shape shape-1"></div>
          <div class="shape shape-2"></div>
          <div class="shape shape-3"></div>
        </div>
      </div>

    </section><!-- /Courses Hero Section -->

    <!-- Featured Quizes Section -->
    <section id="featured-courses" class="featured-courses section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Featured Quizes</h2>
        <p>Explore our most popular quizzes and test your knowledge across various subjects.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="course-card">
              <div class="course-image">
                <img src="{{ asset('assets/front/img/education/students-9.webp') }}" alt="Course" class="img-fluid">
                <div class="badge featured">Featured</div>
                <!-- <div class="price-badge">$149</div> -->
              </div>
              <div class="course-content">
                <div class="course-meta">
                  <span class="level">Duration: 60 Minutes</span>
                  <span class="duration">60 Questions</span>
                </div>
                <h3><a href="#">Digital Marketing Fundamentals</a></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam.</p>
                <a href="enroll.html" class="btn-course">Enroll Now</a>
              </div>
            </div>
          </div><!-- End Course Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="course-card">
              <div class="course-image">
                <img src="{{ asset('assets/front/img/education/students-9.webp') }}" alt="Course" class="img-fluid">
                <div class="badge featured">Featured</div>
                <!-- <div class="price-badge">$149</div> -->
              </div>
              <div class="course-content">
                <div class="course-meta">
                  <span class="level">Duration: 60 Minutes</span>
                  <span class="duration">60 Questions</span>
                </div>
                <h3><a href="#">Digital Marketing Fundamentals</a></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam.</p>
                <a href="enroll.html" class="btn-course">Enroll Now</a>
              </div>
            </div>
          </div><!-- End Course Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="course-card">
              <div class="course-image">
                <img src="{{ asset('assets/front/img/education/students-9.webp') }}" alt="Course" class="img-fluid">
                <div class="badge featured">Featured</div>
                <!-- <div class="price-badge">$149</div> -->
              </div>
              <div class="course-content">
                <div class="course-meta">
                  <span class="level">Duration: 60 Minutes</span>
                  <span class="duration">60 Questions</span>
                </div>
                <h3><a href="#">Digital Marketing Fundamentals</a></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam.</p>
                <a href="enroll.html" class="btn-course">Enroll Now</a>
              </div>
            </div>
          </div><!-- End Course Item -->

          {{-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="course-card">
              <div class="course-image">
                <img src="{{ asset('assets/front/img/education/students-9.webp') }}" alt="Quiz" class="img-fluid">
                <div class="badge featured">Quiz</div>
              </div>
              <div class="course-content">
                <div class="course-meta">
                  <span class="level">60 Questions</span>
                  <span class="duration">60 Minutes</span>
                </div>
                <h3><a href="#">Digital Marketing Quiz</a></h3>
                <p>Test your knowledge of digital marketing concepts including SEO, social media, content marketing, email campaigns, and analytics. Challenge yourself and measure your expertise.</p>
                
                <div class="instructor">
                  <img src="{{ asset('assets/front/img/person/person-f-3.webp') }}" alt="Quiz Creator" class="instructor-img">
                  <div class="instructor-info">
                    <h6>Sarah Johnson</h6>
                    <span>Quiz Creator</span>
                  </div>
                </div>

                  <div class="students">
                    <i class="bi bi-people-fill"></i>
                    <span>342 Attempts</span>
                  </div>
                </div>

                <a href="start-quiz.html" class="btn-course">Start Quiz</a>
              </div>
            </div>
          </div> --}} <!-- End Quiz Item -->

        </div>

        <div class="more-courses text-center" data-aos="fade-up" data-aos-delay="500">
          <a href="courses.html" class="btn-more">View All Quizes</a>
        </div>

      </div>

    </section><!-- /Featured Quizes Section -->

    <!-- Quiz Categories Section -->
    <section id="course-categories" class="course-categories section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Quiz Categories</h2>
        <p>Browse quizzes by category and choose the topic you want to explore.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
            <a href="courses.html" class="category-card category-tech">
              <div class="category-icon">
                <i class="bi bi-laptop"></i>
              </div>
              <h5>Computer Science</h5>
              <span class="course-count">24 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="150">
            <a href="courses.html" class="category-card category-business">
              <div class="category-icon">
                <i class="bi bi-briefcase"></i>
              </div>
              <h5>Business</h5>
              <span class="course-count">18 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
            <a href="courses.html" class="category-card category-design">
              <div class="category-icon">
                <i class="bi bi-palette"></i>
              </div>
              <h5>Design</h5>
              <span class="course-count">15 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="250">
            <a href="courses.html" class="category-card category-health">
              <div class="category-icon">
                <i class="bi bi-heart-pulse"></i>
              </div>
              <h5>Health &amp; Medical</h5>
              <span class="course-count">12 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
            <a href="courses.html" class="category-card category-language">
              <div class="category-icon">
                <i class="bi bi-globe"></i>
              </div>
              <h5>Languages</h5>
              <span class="course-count">21 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="350">
            <a href="courses.html" class="category-card category-science">
              <div class="category-icon">
                <i class="bi bi-diagram-3"></i>
              </div>
              <h5>Science</h5>
              <span class="course-count">16 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
            <a href="courses.html" class="category-card category-marketing">
              <div class="category-icon">
                <i class="bi bi-megaphone"></i>
              </div>
              <h5>Marketing</h5>
              <span class="course-count">19 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="150">
            <a href="courses.html" class="category-card category-finance">
              <div class="category-icon">
                <i class="bi bi-graph-up-arrow"></i>
              </div>
              <h5>Finance</h5>
              <span class="course-count">14 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
            <a href="courses.html" class="category-card category-photography">
              <div class="category-icon">
                <i class="bi bi-camera"></i>
              </div>
              <h5>Photography</h5>
              <span class="course-count">11 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="250">
            <a href="courses.html" class="category-card category-music">
              <div class="category-icon">
                <i class="bi bi-music-note-beamed"></i>
              </div>
              <h5>Music</h5>
              <span class="course-count">13 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
            <a href="courses.html" class="category-card category-engineering">
              <div class="category-icon">
                <i class="bi bi-gear"></i>
              </div>
              <h5>Engineering</h5>
              <span class="course-count">22 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="350">
            <a href="courses.html" class="category-card category-law">
              <div class="category-icon">
                <i class="bi bi-journal-text"></i>
              </div>
              <h5>Law &amp; Legal</h5>
              <span class="course-count">9 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
            <a href="courses.html" class="category-card category-culinary">
              <div class="category-icon">
                <i class="bi bi-cup-hot"></i>
              </div>
              <h5>Culinary Arts</h5>
              <span class="course-count">8 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="150">
            <a href="courses.html" class="category-card category-sports">
              <div class="category-icon">
                <i class="bi bi-trophy"></i>
              </div>
              <h5>Sports &amp; Fitness</h5>
              <span class="course-count">17 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
            <a href="courses.html" class="category-card category-writing">
              <div class="category-icon">
                <i class="bi bi-pen"></i>
              </div>
              <h5>Writing</h5>
              <span class="course-count">10 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="250">
            <a href="courses.html" class="category-card category-psychology">
              <div class="category-icon">
                <i class="bi bi-body-text"></i>
              </div>
              <h5>Psychology</h5>
              <span class="course-count">12 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
            <a href="courses.html" class="category-card category-environment">
              <div class="category-icon">
                <i class="bi bi-tree"></i>
              </div>
              <h5>Environment</h5>
              <span class="course-count">7 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="350">
            <a href="courses.html" class="category-card category-communication">
              <div class="category-icon">
                <i class="bi bi-chat-dots"></i>
              </div>
              <h5>Communication</h5>
              <span class="course-count">15 Quizzes</span>
            </a>
          </div><!-- End Category Item -->

        </div>

      </div>

    </section><!-- /Course Categories Section -->

    <!-- Cta Section -->
    <section id="cta" class="cta section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">

          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="cta-content">
              <h2>Enhance Your Knowledge with QuizMaster</h2>
              <p>Join thousands of learners who are improving their skills through our smart and interactive quiz management platform. Practice, assess, and track your performance in real-time.</p>

              <div class="features-list">
                <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Wide range of categorized quizzes across multiple subjects</span>
                </div>
                <div class="feature-item" data-aos="fade-up" data-aos-delay="350">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Instant results with detailed performance analytics</span>
                </div>
                <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Timed quizzes and practice mode options</span>
                </div>
                <div class="feature-item" data-aos="fade-up" data-aos-delay="450">
                  <i class="bi bi-check-circle-fill"></i>
                  <span>Secure and user-friendly quiz management system</span>
                </div>
              </div>

              <div class="cta-actions" data-aos="fade-up" data-aos-delay="500">
                <a href="quizzes.html" class="btn btn-primary">Browse Quizzes</a>
                <a href="start-quiz.html" class="btn btn-outline">Start Quiz</a>
              </div>

              <div class="stats-row" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="20000" data-purecounter-duration="2" class="purecounter"></span>+</h3>
                  <p>Total Quiz Attempts</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="300" data-purecounter-duration="2" class="purecounter"></span>+</h3>
                  <p>Quizzes Available</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="89" data-purecounter-duration="2" class="purecounter"></span>%</h3>
                  <p>Average Score Rate</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="cta-image">
              <img src="{{ asset('assets/front/img/education/courses-4.webp') }}" alt="QuizMaster Platform" class="img-fluid">
              <div class="floating-element student-card" data-aos="zoom-in" data-aos-delay="600">
                <div class="card-content">
                  <i class="bi bi-person-check-fill"></i>
                  <div class="text">
                    <span class="number">3,200</span>
                    <span class="label">New Quiz Attempts This Month</span>
                  </div>
                </div>
              </div>
              <div class="floating-element course-card" data-aos="zoom-in" data-aos-delay="700">
                <div class="card-content">
                  <i class="bi bi-clipboard-check-fill"></i>
                  <div class="text">
                    <span class="number">75+</span>
                    <span class="label">Active Quiz Categories</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Cta Section -->
@endsection
