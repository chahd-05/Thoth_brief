<link rel="stylesheet" href="/thoth_brief/css/style.css">

<h2>Welcome <?= htmlspecialchars($student['name']) ?></h2>

<div style="text-align: right; margin-bottom: 20px;">
    <form method="POST" action="/thoth_brief/public/student/logout" style="display: inline;">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<div class="dashboard-container">
    <div class="left">
        <h2>Your Courses</h2>

        <?php if(empty($courses)): ?>
            <p>You are not enrolled in any course yet.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php foreach($courses as $course): ?>
                <tr>
                    <td><?= htmlspecialchars($course['title']) ?></td>
                    <td><?= htmlspecialchars($course['description']) ?></td>
                    <td>
                        <form method="POST" action="/thoth_brief/public/student/unenroll" style="display:inline;">
                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>

    <div class="right">
        <h2>Available Courses</h2>

        <?php foreach ($allCourses as $course): ?>
            <div class="course-card">
                <h3><?= htmlspecialchars($course['title']) ?></h3>
                <p><?= htmlspecialchars($course['description']) ?></p>

                <form method="POST" action="/thoth_brief/public/student/enroll">
                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                    <button type="submit">Enroll</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
