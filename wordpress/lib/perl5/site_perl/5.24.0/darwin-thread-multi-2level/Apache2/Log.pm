# 
# /*
#  * *********** WARNING **************
#  * This file generated by ModPerl::WrapXS/0.01
#  * Any changes made here will be lost
#  * ***********************************
#  * 01: lib/ModPerl/Code.pm:716
#  * 02: lib/ModPerl/WrapXS.pm:635
#  * 03: lib/ModPerl/WrapXS.pm:1186
#  * 04: Makefile.PL:435
#  * 05: Makefile.PL:333
#  * 06: Makefile.PL:59
#  */
# 


package Apache2::Log;

use strict;
use warnings FATAL => 'all';



use Apache2::XSLoader ();
our $VERSION = '2.000009';
Apache2::XSLoader::load __PACKAGE__;



1;
__END__

=head1 NAME

Apache2::Log - Perl API for Apache Logging Methods




=head1 Synopsis

  # in startup.pl
  #--------------
  use Apache2::Log;
  
  use Apache2::Const -compile => qw(OK :log);
  use APR::Const    -compile => qw(:error SUCCESS);
  
  my $s = Apache2::ServerUtil->server;
  
  $s->log_error("server: log_error");
  $s->log_serror(__FILE__, __LINE__, Apache2::Const::LOG_ERR,
                 APR::Const::SUCCESS, "log_serror logging at err level");
  $s->log_serror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_DEBUG,
                 APR::Const::ENOTIME, "debug print");
  Apache2::ServerRec->log_error("routine warning");
  
  Apache2::ServerRec::warn("routine warning");

  # in a handler
  #-------------
  package Foo;
  
  use strict;
  use warnings FATAL => 'all';
  
  use Apache2::Log;
  
  use Apache2::Const -compile => qw(OK :log);
  use APR::Const    -compile => qw(:error SUCCESS);
  
  sub handler {
      my $r = shift;
      $r->log_error("request: log_error");
  
      my $rlog = $r->log;
      for my $level qw(emerg alert crit error warn notice info debug) {
          no strict 'refs';
          $rlog->$level($package, "request: $level log level");
      }
  
      # can use server methods as well
      my $s = $r->server;
      $s->log_error("server: log_error");
  
      $r->log_rerror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_DEBUG,
                     APR::Const::ENOTIME, "in debug");
  
      $s->log_serror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_INFO,
                     APR::Const::SUCCESS, "server info");
  
      $s->log_serror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_ERR,
                     APR::Const::ENOTIME, "fatal error");
  
      $r->log_reason("fatal error");
      $r->warn('routine request warning');
      $s->warn('routine server warning');
  
      return Apache2::Const::OK;
  }
  1;

  # in a registry script
  # httpd.conf: PerlOptions +GlobalRequest
  use Apache2::ServerRec qw(warn); # override warn locally
  print "Content-type: text/plain\n\n";
  warn "my warning";


=head1 Description

C<Apache2::Log> provides the Perl API for Apache logging methods.

Depending on the the current C<LogLevel> setting, only logging with
the same log level or higher will be loaded. For example if the
current C<LogLevel> is set to I<warning>, only messages with log level
of the level I<warning> or higher (I<err>, I<crit>, I<elert> and
I<emerg>) will be logged. Therefore this:

  $r->log_rerror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_WARNING,
                 APR::Const::ENOTIME, "warning!");

will log the message, but this one won't:

  $r->log_rerror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_INFO,
                 APR::Const::ENOTIME, "just an info");

It will be logged only if the server log level is set to I<info> or
I<debug>. C<LogLevel> is set in the configuration file, but can be
changed using the
C<L<$s-E<gt>loglevel()|docs::2.0::api::Apache2::ServerRec/C_loglevel_>>
method.

The filename and the line number of the caller are logged only if
C<Apache2::Const::LOG_DEBUG> is used (because that's how Apache 2.0 logging
mechanism works).

Note: On Win32 Apache attempts to lock all writes to a file whenever
it's opened for append (which is the case with logging functions), as
Unix has this behavior built-in, while Win32 does not. Therefore
C<Apache2::Log> functions could be slower than Perl's print()/warn().





=head1 Constants

Log level constants can be compiled all at once:

  use Apache2::Const -compile => qw(:log);

or individually:

  use Apache2::Const -compile => qw(LOG_DEBUG LOG_INFO);




=head2 LogLevel Constants

The following constants (sorted from the most severe level to the
least severe) are used in logging methods to specify the log level at
which the message should be logged:

=head3 C<Apache2::Const::LOG_EMERG>

=head3 C<Apache2::Const::LOG_ALERT>

=head3 C<Apache2::Const::LOG_CRIT>

=head3 C<Apache2::Const::LOG_ERR>

=head3 C<Apache2::Const::LOG_WARNING>

=head3 C<Apache2::Const::LOG_NOTICE>

=head3 C<Apache2::Const::LOG_INFO>

=head3 C<Apache2::Const::LOG_DEBUG>



=head2 Other Constants


Make sure to compile the APR status constants before using them. For
example to compile C<APR::Const::SUCCESS> and all the APR error status
constants do:

  use APR::Const    -compile => qw(:error SUCCESS);

Here is the rest of the logging related constants:


=head3 C<Apache2::Const::LOG_LEVELMASK>

used to mask off the level value, to make sure that the log level's
value is within the proper bits range. e.g.:

  $loglevel &= LOG_LEVELMASK;





=head3 C<Apache2::Const::LOG_TOCLIENT>

used to give content handlers the option of including the error text
in the C<ErrorDocument> sent back to the client. When
C<Apache2::Const::LOG_TOCLIENT> is passed to C<log_rerror()> the error message
will be saved in the C<$r>'s notes table, keyed to the string
I<"error-notes">, if and only if the severity level of the message is
C<Apache2::Const::LOG_WARNING> or greater and there are no other
I<"error-notes"> entry already set in the request record's notes
table. Once the I<"error-notes"> entry is set, it is up to the error
handler to determine whether this text should be sent back to the
client.  For example:

  use Apache2::Const -compile => qw(:log);
  use APR::Const    -compile => qw(ENOTIME);
  $r->log_rerror(Apache2::Log::LOG_MARK,
                 Apache2::Const::LOG_ERR|Apache2::Const::LOG_TOCLIENT,
                 APR::Const::ENOTIME,
                 "request log_rerror");

now the log message can be retrieved via:

  $r->notes->get("error-notes");

Remember that client-generated text streams sent back to the client
B<MUST> be escaped to prevent CSS attacks.





=head3 C<Apache2::Const::LOG_STARTUP>

is useful for startup message where no timestamps, logging level is
wanted. For example:

  use Apache2::Const -compile => qw(:log);
  use APR::Const    -compile => qw(SUCCESS);
  $s->log_serror(Apache2::Log::LOG_MARK,
                 Apache2::Const::LOG_INFO,
                 APR::Const::SUCCESS,
                 "This log message comes with a header");

will print:

  [Wed May 14 16:47:09 2003] [info] This log message comes with a header

whereas, when C<Apache2::Const::LOG_STARTUP> is binary ORed as in:

  use Apache2::Const -compile => qw(:log);
  use APR::Const    -compile => qw(SUCCESS);
  $s->log_serror(Apache2::Log::LOG_MARK,
                 Apache2::Const::LOG_INFO|Apache2::Const::LOG_STARTUP,
                 APR::Const::SUCCESS,
                 "This log message comes with no header");

then the logging will be:

  This log message comes with no header




=head1 Server Logging Methods


=head2 C<$s-E<gt>log>

get a log handle which can be used to L<log messages of different
levels|/LogLevel_Methods>.

  my $slog = $s->log;

=over 4

=item obj: C<$s>
( C<L<Apache2::ServerRec object|docs::2.0::api::Apache2::ServerRec>> )

=item ret: C<$slog> ( C<Apache2::Log::Server> object )

C<Apache2::Log::Server> object to be used with L<LogLevel
methods|/LogLevel_Methods>.

=item since: 2.0.00

=back






=head2 C<$s-E<gt>log_error>

just logs the supplied message to I<error_log>

  $s->log_error(@message);

=over 4

=item obj: C<$s>
( C<L<Apache2::ServerRec object|docs::2.0::api::Apache2::ServerRec>> )

=item arg1: C<@message> ( strings ARRAY )

what to log

=item ret: no return value

=item since: 2.0.00

=back

For example:

  $s->log_error("running low on memory");





=head2 C<$s-E<gt>log_serror>

This function provides a fine control of when the message is logged,
gives an access to built-in status codes.

  $s->log_serror($file, $line, $level, $status, @message);

=over 4

=item obj: C<$s>
( C<L<Apache2::ServerRec object|docs::2.0::api::Apache2::ServerRec>> )

=item arg1: C<$file> ( string )

The file in which this function is called

=item arg2: C<$line> ( number )

The line number on which this function is called

=item arg3: C<$level>
( C<L<Apache2::LOG_* constant|/LogLevel_Constants>> )

The level of this error message

=item arg4: C<$status>
( C<L<APR::Const status constant|docs::2.0::api::APR::Const>> )

The status code from the last command (similar to $! in perl), usually
C<L<APR::Const constant|docs::2.0::api::APR::Const>> or coming from an
L<exception object|docs::2.0::api::APR::Error>.

=item arg5: C<@message> ( strings ARRAY )

The log message(s)

=item ret: no return value

=item since: 2.0.00

=back

For example:

  use Apache2::Const -compile => qw(:log);
  use APR::Const    -compile => qw(ENOTIME SUCCESS);
  $s->log_serror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_ERR,
                 APR::Const::SUCCESS, "log_serror logging at err level");
  
  $s->log_serror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_DEBUG,
                 APR::Const::ENOTIME, "debug print");







=head2 C<$s-E<gt>warn>

  $s->warn(@warnings);

is the same as:

  $s->log_serror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_WARNING,
                 APR::Const::SUCCESS, @warnings)

=over 4

=item obj: C<$s>
( C<L<Apache2::ServerRec object|docs::2.0::api::Apache2::ServerRec>> )

=item arg1: C<@warnings> ( strings ARRAY )

array of warning strings

=item ret: no return value

=item since: 2.0.00

=back

For example:

  $s->warn('routine server warning');







=head1 Request Logging Methods





=head2 C<$r-E<gt>log>

get a log handle which can be used to L<log messages of different
levels|/LogLevel_Methods>.

  $rlog = $r->log;

=over 4

=item obj: C<$r> 
( C<L<Apache2::RequestRec object|docs::2.0::api::Apache2::RequestRec>> )

=item ret: C<$rlog> ( C<Apache2::Log::Request> object )

C<Apache2::Log::Request> object to be used with L<LogLevel
methods|/LogLevel_Methods>.

=item since: 2.0.00

=back






=head2 C<$r-E<gt>log_error>

just logs the supplied message (similar to
C<L<$s-E<gt>log_error|/C__s_E_gt_log_error_>> ).

  $r->log_error(@message);

=over 4

=item obj: C<$r>
( C<L<Apache2::RequestRec object|docs::2.0::api::Apache2::RequestRec>> )

=item arg1: C<@message> ( strings ARRAY )

what to log

=item ret: no return value

=item since: 2.0.00


=back

For example:

  $r->log_error("the request is about to end");






=head2 C<$r-E<gt>log_reason>

This function provides a convenient way to log errors in a
preformatted way:

  $r->log_reason($message);
  $r->log_reason($message, $filename);

=over 4

=item obj: C<$r>
( C<L<Apache2::RequestRec object|docs::2.0::api::Apache2::RequestRec>> )

=item arg1: C<$message> ( string )

the message to log

=item opt arg2: C<$filename> ( string )

where to report the error as coming from (e.g. C<__FILE__>)

=item ret: no return value

=item since: 2.0.00

=back

For example:

  $r->log_reason("There is no enough data");

will generate a log entry similar to the following:

  [Fri Sep 24 11:58:36 2004] [error] access to /someuri
  failed for 127.0.0.1, reason: There is no enough data.







=head2 C<$r-E<gt>log_rerror>

This function provides a fine control of when the message is logged,
gives an access to built-in status codes.

  $r->log_rerror($file, $line, $level, $status, @message);

arguments are identical to
C<L<$s-E<gt>log_serror|/C__s_E_gt_log_serror_>>.

=over 4

=item since: 2.0.00

=back

For example:

  use Apache2::Const -compile => qw(:log);
  use APR::Const    -compile => qw(ENOTIME SUCCESS);
  $r->log_rerror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_ERR,
                 APR::Const::SUCCESS, "log_rerror logging at err level");
  
  $r->log_rerror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_DEBUG,
                 APR::Const::ENOTIME, "debug print");





=head2 C<$r-E<gt>warn>

  $r->warn(@warnings);

is the same as:

  $r->log_rerror(Apache2::Log::LOG_MARK, Apache2::Const::LOG_WARNING,
                 APR::Const::SUCCESS, @warnings)

=over 4

=item obj: C<$r>
( C<L<Apache2::RequestRec object|docs::2.0::api::Apache2::RequestRec>> )

=item arg1: C<@warnings> ( strings ARRAY )

array of warning strings

=item ret: no return value

=item since: 2.0.00

=back

For example:

  $r->warn('routine server warning');







=head1 Other Logging Methods

=head2 LogLevel Methods

after getting the log handle with C<L<$s-E<gt>log|/C__s_E_gt_log_>> or
C<L<$r-E<gt>log|/C__s_E_gt_log_>>, use one of the following methods
(corresponding to the C<LogLevel> levels):

  emerg(), alert(), crit(), error(), warn(), notice(), info(), debug()

to control when messages should be logged:

  $s->log->emerg(@message);
  $r->log->emerg(@message);

=over 4

=item obj: C<$slog> ( L<server|/C__s_E_gt_log_> or
L<request|/C__s_E_gt_log_> log handle )

=item arg1: C<@message> ( strings ARRAY )

=item ret: no return value

=item since: 2.0.00

=back

For example if the C<LogLevel> is C<error> and the following code is
executed:

  my $slog = $s->log;
  $slog->debug("just ", "some debug info");
  $slog->warn(@warnings);
  $slog->crit("dying");

only the last command's logging will be performed. This is because
I<warn>, I<debug> and other logging command which are listed right to
I<error> will be disabled.





=head2 C<alert>

See L<LogLevel Methods|/LogLevel_Methods>.



=head2 C<crit>

See L<LogLevel Methods|/LogLevel_Methods>.



=head2 C<debug>

See L<LogLevel Methods|/LogLevel_Methods>.



=head2 C<emerg>

See L<LogLevel Methods|/LogLevel_Methods>.



=head2 C<error>

See L<LogLevel Methods|/LogLevel_Methods>.



=head2 C<info>

See L<LogLevel Methods|/LogLevel_Methods>.



=head2 C<notice>

See L<LogLevel Methods|/LogLevel_Methods>.

Though Apache treats C<notice()> calls as special. The message is
always logged regardless the value of C<ErrorLog>, unless the error
log is set to use syslog. (For details see httpd-2.0/server/log.c.)



=head2 C<warn>

See L<LogLevel Methods|/LogLevel_Methods>.






=head1 General Functions





=head2 C<LOG_MARK>

Though looking like a constant, this is a function, which returns a
list of two items: C<(__FILE__, __LINE__)>, i.e. the file and the line
where the function was called from.

  my ($file, $line) = Apache2::Log::LOG_MARK();

=over 4

=item ret1: C<$file> ( string )

=item ret2: C<$line> ( number )

=item since: 2.0.00

=back

It's mostly useful to be passed as the first argument to those logging
methods, expecting the filename and the line number as the first
arguments (e.g., C<L<$s-E<gt>log_serror|/C__s_E_gt_log_serror_>> and
C<L<$r-E<gt>log_rerror|/C__r_E_gt_log_rerror_>> ).




=head1 Virtual Hosts

Code running from within a virtual host needs to be able to log into
its C<ErrorLog> file, if different from the main log. Calling any of
the logging methods on the C<$r> and C<$s> objects will do the logging
correctly.

If the core C<warn()> is called, it'll be always logged to the main
log file. Here is how to make it log into the vhost F<error_log> file.
Let's say that we start with the following code:

  warn "the code is smoking";

=over

=item 1

First, we need to use mod_perl's logging function, instead of
C<CORE::warn>

Either replace C<warn> with C<Apache2::ServerRec::warn>:

  use Apache2::Log ();
  Apache2::ServerRec::warn("the code is smoking");

or import it into your code:

  use Apache2::ServerRec qw(warn); # override warn locally
  warn "the code is smoking";

or override C<CORE::warn>:

  use Apache2::Log ();
  *CORE::GLOBAL::warn = \&Apache2::ServerRec::warn;
  warn "the code is smoking";

Avoid using the latter suggestion, since it'll affect all the code
running on the server, which may break things. Of course you can
localize that as well:

  use Apache2::Log ();
  local *CORE::GLOBAL::warn = \&Apache2::ServerRec::warn;
  warn "the code is smoking";

Chances are that you need to make the internal Perl warnings go into
the vhost's F<error_log> file as well. Here is how to do that:

  use Apache2::Log ();
  local $SIG{__WARN__} = \&Apache2::ServerRec::warn;
  eval q[my $x = "aaa" + 1;]; # this issues a warning

Notice that it'll override any previous setting you may have had,
disabling modules like C<CGI::Carp> which also use C<$SIG{__WARN__}>

=item 2

Next we need to figure out how to get hold of the vhost's server
object.

Inside HTTP request handlers this is possible via
C<L<Apache2-E<gt>request|docs::2.0::api::Apache2::RequestUtil/C_request_>>.
Which requires either C<L<PerlOptions
+GlobalRequest|docs::2.0::user::config::config/C_GlobalRequest_>>
setting or can be also done at runtime if C<$r> is available:

  use Apache2::RequestUtil ();
  sub handler {
      my $r = shift;
      Apache2::RequestUtil->request($r);
      ...

Outside HTTP handlers at the moment it is not possible, to get hold of
the vhost's F<error_log> file. This shouldn't be a problem for the
code that runs only under mod_perl, since the always available C<$s>
object can invoke a plethora of methods supplied by
C<Apache2::Log>. This is only a problem for modules, which are supposed
to run outside mod_perl as well.

META: To solve this we think to introduce 'PerlOptions +GlobalServer',
a big brother for 'PerlOptions +GlobalRequest', which will be set in
modperl_hook_pre_connection.


=back







=head1 Unsupported API

C<Apache2::Log> also provides auto-generated Perl interface for a few
other methods which aren't tested at the moment and therefore their
API is a subject to change. These methods will be finalized later as a
need arises. If you want to rely on any of the following methods
please contact the L<the mod_perl development mailing
list|maillist::dev> so we can help each other take the steps necessary
to shift the method to an officially supported API.


=head2 C<log_pid>

META: what is this method good for? it just calls getpid and logs
it. In any case it has nothing to do with the logging API. And it uses
static variables, it probably shouldn't be in the Apache public API.

Log the current pid

  Apache2::Log::log_pid($pool, $fname);

=over 4

=item obj: C<$p> ( C<L<APR::Pool object|docs::2.0::api::APR::Pool>> )

The pool to use for logging

=item arg1: C<$fname> ( file path )

The name of the file to log to

=item ret: no return value

=item since: subject to change


=back






=head1 See Also

L<mod_perl 2.0 documentation|docs::2.0::index>.




=head1 Copyright

mod_perl 2.0 and its core modules are copyrighted under
The Apache Software License, Version 2.0.




=head1 Authors

L<The mod_perl development team and numerous
contributors|about::contributors::people>.

=cut

