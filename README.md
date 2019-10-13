# 说明
新手啊，用SDK太复杂，我都有点搞得似懂非懂，好麻烦，自己研究了一下搞了一个很原生的通用版本来用<br />
需要授权的暂时用不了，还没有搞，看以后要用的话再来搞<br />
tbk的API写了一部分在tbk.php里面，参数全部以数组形式传入，如果需要其他接口，直接以数组形式闯入数据即可，全部通用

# 用法
我是用在thinkcmf5.1里面，thinkphp（支持命名空间的版本）都可以通用<br />
1，将tbk.php放到自定义扩展类库目录-》根目录下面的extend目录<br />
2，将demo.php放到自己的应用控制器目录，比如（app\portal\controller）<br />
3，如果应用是portal，则访问如地址是http://domain/portal/demo/index
