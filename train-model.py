import pymysql
import numpy
import datetime
db = pymysql.connect(host="localhost",    # localhost
                     user="root",         # username
                     passwd="",           # password
                     db="findword")        # database
cur = db.cursor()

# back up và truncate bảng models
print('back up lại bảng models.....')
cur.execute("SELECT * FROM models;")
f = open('backup-model-'+datetime.datetime.now().strftime("%Y-%m-%d %H-%M-%S")+'.txt','w')
for row in cur.fetchall():
    f.writelines(str(row)+'\n')
print('truncate bảng models.....')
cur.execute("TRUNCATE TABLE models;")



# lấy kỹ năng (skill) 
print('lấy danh sách kỹ năng.....')
cur.execute("SELECT skills.id FROM skills;")
skills = cur.fetchall()[-1][0]+1
d = skills - 1



print('lấy danh sách công việc.....')
# lấy công việc (work)
cur.execute("SELECT works.id FROM works;")
works = cur.fetchall()[-1][0]+1



# tạo mảng 2 chiều rỗng,dùng để lưu trữ đếm skill đi với work
train = numpy.zeros(shape=(skills,works))
N = numpy.zeros(shape=(works))



print('lấy dữ liệu chuẩn bị train.....')
# lấy skill_id của cv + work_id của post với những cv đã apply vào post
cur.execute('SELECT cv_skill.skill_id, posts.work_id FROM cv_skill,cv_post,posts WHERE cv_skill.cv_id = cv_post.cv_id AND cv_post.post_id = posts.id;')
rows = cur.fetchall()
# lặp tất cả bản ghi
for row in rows:
    # đếm số lần xuất hiện của skill với work
    train[row[0]][row[1]] = train[row[0]][row[1]] + 1
    # đếm tổng số skill với mỗi work tương ứng
    N[row[1]] = N[row[1]] + 1



print('train.....')
# lặp mảng 2 chiều
for i in range(1,skills):
    for j in range(1,works):
        # tính tỷ lệ, dùng Laplace smoothing với α=1
        train[i][j] = (train[i][j]+1)/(N[j] + d)
# lấy tất cả work_id của bài đăng được cv ứng tuyển
cur.execute('SELECT posts.work_id FROM cv_post,posts WHERE cv_post.post_id = posts.id;')
rows = cur.fetchall()
# lấy tổng số lượng bản ghi 
all = len(rows)
# tạo mảng rỗng chứa số lượng được apply của từng work_id
P = numpy.zeros(shape=(works))
for row in rows:
    # lặp từng bản ghi,đếm số lượng work_id được apply
    P[row[0]] = P[row[0]] + 1
# tính tỷ lệ số lượng apply của từng work_id / tổng số lượng apply
for i in range(1,works):
    P[i] = P[i] / all
# lưu vào mảng train với skill_id là 0
for i in range(1,works):
    train[0][i] = P[i]



print('lưu model mới vào bảng models.....')
for i in range(0,skills):
    for j in range(1,works):
        # lưu kết quả đã train vào bảng model
        if i == 0:
            txt = 'NULL'
        else:
            txt = str(i)
        sql = "INSERT INTO models VALUES (NULL, "+ txt +", " + str(j) + ", '" + str(train[i][j]) + "', NULL, NULL);"
        cur.execute(sql)
db.commit()
db.close()
print('kết thúc.....')